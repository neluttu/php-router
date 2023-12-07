<?
use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$userID = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $_POST['id']
                    ])->findOrFail();

authorize($note['user_id'] === $userID);

$errors = [];

if(!Validator::string($_POST['note'], 1, 500)) {
    $errors['note'] = 'Invalid note length';
}

if(!empty($errors)) { 
    return view('notes/edit.view.php', [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes set note = :note where id = :note_id', [
    ':note' => $_POST['note'],
    ':note_id' => $_POST['id']
]);

header('Location: /notes');
die();