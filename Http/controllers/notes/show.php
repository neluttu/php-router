<?

use Core\App;

$db = App::resolve('Core\Database');

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $params['id']
                    ])->findOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

view('notes/note.view.php', [
    'heading' => 'View note',
    'note' => $note
]);

?>