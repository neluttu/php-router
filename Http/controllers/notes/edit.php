<?
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$userID = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();


authorize($note['user_id'] === $userID);
view('notes/edit.view.php', [
    'heading' => 'Edit note',
    'errors' => [],
    'note' => $note
]);