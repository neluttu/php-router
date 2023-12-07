<?

use Core\Session;

view('session/create.view.php',[
    'heading' => 'Your account',
    'errors' => Session::get('errors')
]);