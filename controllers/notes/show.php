<?php

use Core\Database;
$config = require base_path('config.php');

$db = new Database($config['database']);

$currentUserId = 3;


$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->findOrFail();
    
    
authorise($note['user_id'] === $currentUserId);
    
    
view("notes/show.view.php", [
    'heading' => 'My Note',
    'note' => $note
]);



