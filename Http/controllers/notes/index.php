<?
use Core\App;

$db = App::resolve('Core\Database');

$notes = $db->query('SELECT * FROM notes WHERE user_id = '.$_SESSION['user']['id'].' ORDER BY ID DESC')->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
    ]);
?>