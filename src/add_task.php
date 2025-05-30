<?php
require 'db.php';

if (!isset($_SESSION['user_id']) || empty($_POST['task_description'])) {
        header('Location: index.php');
        exit();
}

$stmt = $pdo->prepare("INSERT INTO tasks (user_id, description) VALUES (?, ?)");
$stmt->execute([$_SESSION['user_id'], $_POST['task_description']]);
header('Location: index.php');
exit();
