<?

use Core\Session;

view('session/create',[
    'heading' => 'Your account',
    'errors' => Session::get('errors')
]);