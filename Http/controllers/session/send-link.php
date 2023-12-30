<?
use Http\Forms\ResetForm;
use Core\Token;
use Core\Session;
use Core\App;
use Core\Database;
use Core\EmailSender;

$form = new ResetForm();
$email = $_POST['email'];

// Dev unset token request.
//unset($_SESSION['token'],$_SESSION['token_expires']);

if(Session::has('token') and Session::has('token_expires') > time()) {
    Session::flash('message', ['success' => 'We\'ve already sent a reset password link. You can request another one in about ' . round(abs($_SESSION['token_expires'] - time()) / 60) . ' minutes.']);
    return redirect('/login');
} else unset($_SESSION['token'],$_SESSION['token_expires']);


if (!($user = App::resolve(Database::class)
    ->query("SELECT id, token, expires_at, used FROM users LEFT JOIN password_reset_requests ON password_reset_requests.user_id = users.id WHERE email = :email ORDER BY request_id DESC", ['email' => $email])
    ->find()))
    $form->appendError('user_error', 'User does not exist?!');

// Check if token exists or not and recovery is possible.
$active_token = $user['token'] ? (strtotime($user['expires_at']) < time() ? false : true) : false;

if($active_token and $user['used'] == 'No') {
    $form->appendError('reset_active',  'We\'ve already sent a reset password link. You can request another one in about ' . round(abs(strtotime($user['expires_at']) - time()) / 60) . ' minutes.');
}

$form->validate($email);

if(empty($form->errors())) {
        $token = new Token();
        $store = App::resolve(Database::class)->query("INSERT INTO password_reset_requests (user_id, token, expires_at) VALUES ('".$user['id']."', '" . $token->getToken() . "', DATE_ADD(NOW(), INTERVAL 5 MINUTE))");
        // send email with token link.

        $emailSender = new EmailSender();
        
        $emailSender->sendEmail(
            $user['email'],
            'Subject of the Email',
            '../views/emails/ResetPasswordLink.html',
            ['name' => 'Neluttu',  'key' => $token->getToken()]
        );
                
        // flash message and redirect to success page.
        Session::flash('message', ['success' => 'We\'ve sent you a email with a password reset link.']);
        Session::put('token', $token->getToken());
        Session::put('token_expires', strtotime("+5 minutes"));
        return redirect('/login');
}

Session::flash('errors', $form->errors());
Session::flash('old', [ 
                    'email' => $email
            ]);

return redirect('/reset-password');