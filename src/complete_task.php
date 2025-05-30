<?php
require 'db.php';

if (!isset($_SESSION['user_id']) || empty($_POST['task_id'])) {
        header('Location: index.php');
        exit();
}


$stmt = $pdo->prepare("UPDATE tasks SET status = 'completed' WHERE task_id = ? AND user_id = ?");
$stmt->execute([$_POST['task_id'], $_SESSION['user_id']]);
header('Location: index.php');
exit();
