<?
use Core\Validator;
use Core\App;
use Core\Database;

$email = $_POST['email'];
$password = $_POST['password'];

// validate email and password

if(! Validator::email($email))
    $errors['email'] = 'Please provide a valid email';

if(! Validator::string($password, 7, 255))
    $errors['password'] = 'Password must be at least 7 characters long and at least 255 characters.';


if(!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors,
        'heading' => 'Registration'
    ]);
}    

$db = App::resolve(Database::class);

$user = $db->query("SELECT * FROM users WHERE email = :email", [
    ':email' => $email
])->find();


if($user) {
    header('Location: /');
    exit();
}
else {
    $db->query("INSERT INTO users(email, password, name) VALUES (:email, :password, :name)",[
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'name' => 'Neluttu'
    ]);

    $_SESSION['user'] = [
        'email' => $email,
        'name' => 'Neluttu',
        'id' => $db->getLastID()
    ];

    dd($_SESSION);
    session_regenerate_id(true);

    header('Location: /notes');
}