<?

$router->get('/', 'index.php');

$router->get('/about', 'about.php');

$router->get('/contact', 'contact.php');

$router->get('/products', 'products/index.php');

$router->get('/product/{product}/{id}', 'products/view.php');
$router->post('/product/{product}/{id}', 'cart/store-cart.php');

$router->get('/products/{category}/{id}', 'products/products.php');
$router->post('/products/{category}/{id}', 'products/products.php');

$router->get('/cart', '/cart/index.php');
$router->post('/cart', '/cart/update-cart.php');
$router->get('/checkout', 'cart/checkout.php');

$router->get('/notes', 'notes/index.php')->only('auth', '/login');

$router->get('/note/{id}', 'notes/show.php')->only('auth', '/login');

$router->post('/notes', 'notes/store.php')->only('auth', '/login');

$router->get('/notes/create', 'notes/create.php')->only('auth', '/login');

$router->delete('/notes', 'notes/destroy.php')->only('auth', '/login');

$router->get('/note/edit/{id}', 'notes/edit.php')->only('auth', '/login');

$router->patch('/note', 'notes/update.php')->only('auth', '/login');

$router->get('/account', 'account/index.php')->only('auth', '/login');
$router->get('/account', 'account/orders.php')->only('auth', '/login');


$router->get('/register', 'register/index.php')->only('guest', '/account');

$router->post('/register', 'register/store.php')->only('guest', '/account');

$router->get('/login', 'session/create.php')->only('guest', '/account');

$router->get('/reset-password', 'session/reset-password.php')->only('guest', '/account');
$router->post('/reset-password', 'session/send-link.php')->only('guest', '/account');

$router->get('/set-password/{token}', 'session/set-password.php')->only('guest', '/account');
$router->post('/set-password/{token}', 'session/update-password.php')->only('guest', '/account');


$router->post('/session', 'session/store.php')->only('guest', '/account');
$router->delete('/logout', 'session/destroy.php')->only('auth', '/login');

// $router->delete('/logout', function () { 
//                                 Core\Session::destroy();
//                                 redirect();
//                             });

?>