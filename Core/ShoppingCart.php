<?
namespace Core;

class ShoppingCart
{
    private $sessionKey;

    public function __construct($sessionKey = 'cart')
    {
        $this->sessionKey = $sessionKey;

        // Initialize the cart session variable if not set
        if (!isset($_SESSION[$this->sessionKey]) || !is_array($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    public function addProduct($product)
    {
        if (!$this->isProductInCart($product)) {
            $cartKey = uniqid();
            $_SESSION[$this->sessionKey][$cartKey] = [
                'id' => (int) $product['id'],
                'name' => $product['name'],
                'quantity' => (int) $product['quantity'],
                'price' => (float) $product['price'],
                'features' => $this->extractProductFeatures($product),
            ];

            return 'Product added to your <a href="'.\Core\Session::getLang().'/cart" class="underline">shopping cart!</a>';
        } else {
            return 'Product already in cart, visit <a href="'.\Core\Session::getLang().'/cart" class="underline">your cart</a> to update the quantity if desired.';
        }
    }

    private function isProductInCart($product)
    {
        foreach ($_SESSION[$this->sessionKey] as $key => $_) {
            if ($product['id'] == $_SESSION[$this->sessionKey][$key]['id']) {
                if (empty(array_diff_assoc($_SESSION[$this->sessionKey][$key]['features'], $this->extractProductFeatures($product)))) {
                    return true; // Product found in cart
                }
            }
        }

        return false; // Product not found in cart
    }

    private function extractProductFeatures($product)
    {
        $features = $product;
        // Remove base product variables so we get only custom product features.
        unset($features['id'], $features['name'], $features['quantity'], $features['price']);

        return $features;
    }

    public function updateProduct($postData)
    {
        if (!empty($postData['cartID']) && array_key_exists($postData['cartID'], $_SESSION[$this->sessionKey])) {
            if (isset($_SESSION[$this->sessionKey]) && count($_SESSION[$this->sessionKey]) > 0) {
                // Update cart item.
                $cartID = $postData['cartID'];
                $productName = $_SESSION[$this->sessionKey][$cartID]['name'];

                if ((int)$postData['quantity'] === 0) {
                    unset($_SESSION[$this->sessionKey][$cartID]);
                    return "<b>$productName</b> was removed from the cart.";
                } else {
                    $_SESSION[$this->sessionKey][$cartID]['quantity'] = (int)$postData['quantity'];
                    return "Quantity updated for <b> " . $productName . "</b>.";
                }
            } else {
                return 'There are no products in your shopping cart.';
            }
        } else {
            return 'Product does not exist in the shopping cart...';
        }
    }    

    public static function getTotalItemsInCart() {
        $TotalItemsInCart = 0;
            if(!empty($_SESSION["cart"])) {
            
            foreach($_SESSION['cart'] as $_ => $value) {
                $TotalItemsInCart += (int) $value['quantity'];
            }
            return $TotalItemsInCart;
        }
        else return 0;
    }

    public static function getCartPrice() {
        $Price = 0;
        if(!empty($_SESSION["cart"])) {
            
            foreach($_SESSION['cart'] as $_ => $value) {
                $Price += (float) $value['price'] * (int) $value['quantity'];
            }
            return '$' . number_format($Price, 2);
        }
        else return 0;
    }
}