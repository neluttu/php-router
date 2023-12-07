<?
use Core\App;

$db = App::resolve('Core\Database');

$userID = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', 
                    [
                        'id' => $_POST['id']
                    ])->findOrFail();

authorize($note['user_id'] === $userID);

$db->query("DELETE FROM notes WHERE id = :id",[
    ':id' => $_POST['id']
]);

header('Location: /notes');
die();


?>