<?php

use Core\Validator;
use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if (! Validator::string($_POST['body'])) {  
        $errors['body'] = 'A body is required of at least 1 and no more than 255 characters.';
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create note',
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    $db->query('INSERT INTO notes(body, user_id) values(:body, :user_id)', [
        'body' => htmlspecialchars($_POST['body']),
        'user_id' => 3
    ]);
    
    header('location: /notes');
    die();
}
