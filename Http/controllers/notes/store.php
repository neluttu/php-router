<?

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$errors = [];

if(!Validator::string($_POST['note'], 1, 500)) {
    $errors['note'] = 'Invalid note length';
}

if(!empty($errors)) { 
    return view('notes/create.view.php', [
        'heading' => 'Create new note',
        'errors' => $errors
    ]);
}


$db->query("INSERT INTO notes (note, user_id) VALUES (:note, :user_id)", [
    'note' => $_POST['note'],
    'user_id' => 1
]);

header('Location: /notes');
die();
