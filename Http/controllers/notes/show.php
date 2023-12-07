<?

use Core\App;

$db = App::resolve('Core\Database');

$userID = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();


authorize($note['user_id'] === $userID);

view('notes/note.view.php', [
    'heading' => 'View note',
    'note' => $note
]);

?>