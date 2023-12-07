<?

$router->get('/', 'index.php');

$router->get('/about', 'about.php');

$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');

//$router->get('/notes/user/{user}/challenge/{type}', 'notes/index.php');

$router->get('/note/{id}', 'notes/show.php')->only('auth');

$router->post('/notes', 'notes/store.php')->only('auth');

$router->get('/notes/create', 'notes/create.php');

$router->delete('/notes', 'notes/destroy.php')->only('auth');

$router->get('/note/edit/{id}', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');

$router->get('/register', 'register/create.php')->only('guest');
$router->post('/register', 'register/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/logout', 'session/destroy.php')->only('auth');

?>

