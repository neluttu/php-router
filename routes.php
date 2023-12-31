<?

use Core\App;
use Core\Database;

$db = App::resolve(Database::class)->query("SELECT * FROM routes ORDER BY page ASC")->get();

foreach ($db as $route) {
    $method = $route['method'];
    if(empty($route['middleware']))
        $router->$method('/{lang}' . $route['uri'], $route['controller']);
    else 
        $router->$method('/{lang}' . $route['uri'], $route['controller'])->only($route['middleware'], $route['middleware_redirect']);
}
//dd($router);
//$router->get('/', 'index.php');


// $router->get('/{lang}/contact', 'contact.php');

// $router->get('/{lang}/products', 'products/index.php');

// $router->get('/{lang}/product/{product}/{id}', 'products/view.php');
// $router->post('/{lang}/product/{product}/{id}', 'cart/store-cart.php');

// $router->get('/{lang}/products/{category}/{id}', 'products/products.php');
// $router->post('/{lang}/products/{category}/{id}', 'products/products.php');

// $router->get('/{lang}/cart', '/cart/index.php');
// $router->post('/{lang}/cart', '/cart/update-cart.php');
// $router->get('/{lang}/checkout', 'cart/checkout.php');

// $router->get('/{lang}/notes', 'notes/index.php')->only('auth', '/login');

// $router->get('/{lang}/note/{id}', 'notes/show.php')->only('auth', '/login');

// $router->post('/{lang}/notes', 'notes/store.php')->only('auth', '/login');

// $router->get('/{lang}/notes/create', 'notes/create.php')->only('auth', '/login');

// $router->delete('/{lang}/notes', 'notes/destroy.php')->only('auth', '/login');

// $router->get('/{lang}/note/edit/{id}', 'notes/edit.php')->only('auth', '/login');

// $router->patch('/{lang}/note', 'notes/update.php')->only('auth', '/login');

// $router->get('/{lang}/account', 'account/index.php')->only('auth', '/login');
// $router->get('/{lang}/account', 'account/orders.php')->only('auth', '/login');


// $router->get('/{lang}/register', 'register/index.php')->only('guest', '/account');

// $router->post('/{lang}/register', 'register/store.php')->only('guest', '/account');

// $router->get('/{lang}/login', 'session/create.php')->only('guest', '/account');

// $router->get('/{lang}/reset-password', 'session/reset-password.php')->only('guest', '/account');
// $router->post('/{lang}/reset-password', 'session/send-link.php')->only('guest', '/account');

// $router->get('/{lang}/set-password/{token}', 'session/set-password.php')->only('guest', '/account');
// $router->post('/{lang}/set-password/{token}', 'session/update-password.php')->only('guest', '/account');


// $router->post('/session', 'session/store.php')->only('guest', '/account');
// $router->delete('/logout', 'session/destroy.php')->only('auth', '/login');

