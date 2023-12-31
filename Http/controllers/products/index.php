<?
use Core\App;
use Core\Session;

$db = App::resolve('Core\Database');

$categories = $db->query('
                        SELECT categories.*, COUNT(products.id) AS count
                        FROM categories
                        LEFT JOIN products ON categories.id = products.category
                        GROUP BY categories.id
                        ORDER BY categories.id ASC
                    ')->get();

view('products/index', [
    'heading' => 'Product categories',
    'categories' => $categories
]);