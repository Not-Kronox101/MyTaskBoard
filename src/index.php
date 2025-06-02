<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>Todo App - Task Board</title>
</head>

<body>

    <h1>Task Board</h1>

    <form id="addTaskForm" action="add_task.php" method="POST" autocomplete="off">
        <input type="text" name="task_description" required placeholder="New Task Description" maxlength="255" />
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <ul class="task-list" id="taskList">
        <?php foreach ($tasks as $task): ?>
            <li class="<?= $task['status'] === 'completed' ? 'completed' : '' ?>">
                <span class="task-desc"><?= htmlspecialchars($task['description']) ?></span>


                <div class="btn-group">
                    <?php if ($task['status'] === 'pending'): ?>
                        <form action="complete_task.php" method="POST" style="display:inline;">
                            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                            <button type="submit" class="btn-complete">Complete</button>
                        </form>
                    <?php endif; ?>
                    <form action="delete_task.php" method="POST" style="display:inline;">
                        <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>

    <a class="logout-link" href="logout.php">Logout</a>

</body>

</html>