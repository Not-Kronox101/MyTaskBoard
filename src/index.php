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
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            margin: 0;
            padding: 0 1rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-top: 2rem;
            font-weight: 700;
            font-size: 2.5rem;
            letter-spacing: 2px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
        }

        form#addTaskForm {
            margin: 1.5rem 0;
            display: flex;
            width: 100%;
            max-width: 600px;
        }

        input[name="task_description"] {
            flex-grow: 1;
            padding: 0.8rem 1rem;
            border-radius: 25px 0 0 25px;
            border: none;
            font-size: 1rem;
            outline: none;
            transition: box-shadow 0.3s ease;
        }

        input[name="task_description"]:focus {
            box-shadow: 0 0 10px 2px #ffd700;
        }

        button[type="submit"] {
            background: #ffd700;
            border: none;
            padding: 0 1.8rem;
            border-radius: 0 25px 25px 0;
            font-weight: 700;
            cursor: pointer;
            color: #333;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background: #ffbf00;
        }

        h2 {
            margin-top: 3rem;
            font-weight: 600;
            font-size: 1.8rem;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
        }

        ul.task-list {
            list-style: none;
            padding: 0;
            max-width: 600px;
            width: 100%;
            margin-bottom: 4rem;
        }

        ul.task-list li {
            background: rgba(255, 255, 255, 0.1);
            margin-bottom: 0.8rem;
            border-radius: 15px;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease;
        }

        ul.task-list li.completed {
            background: rgba(0, 128, 0, 0.4);
            text-decoration: line-through;
            color: #ccc;
        }

        .task-desc {
            flex-grow: 1;
            font-size: 1.1rem;
            margin-right: 1rem;
            word-break: break-word;
        }

        .status-badge {
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;

            margin-right: 1rem;
            user-select: none;
        }

        .status-pending {
            background: #f0ad4e;
            color: #fff;
        }

        .status-completed {
            background: #5cb85c;
            color: #fff;
        }

        .btn-group form {
            display: inline-block;
            margin-left: 0.5rem;
        }

        button.action-btn {
            background: #333;
            color: #fff;
            border: none;
            padding: 0.35rem 0.7rem;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        button.action-btn:hover {
            background: #555;
        }





        button.btn-complete {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        button.btn-complete:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        button.btn-delete {
            background: #333;
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        button.btn-delete:hover {
            background: #555;
            transform: scale(1.05);
        }



        .btn-group {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }




        a.logout-link {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background: #ff4b5c;
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        a.logout-link:hover {
            background: #e43d4a;
        }
    </style>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const deleteForms = document.querySelectorAll('form[action="delete_task.php"]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', (e) => {
                    const li = form.closest('li');
                    if (!li) return;

                    if (!li.classList.contains('completed')) {
                        const confirmed = window.confirm('This task is not completed. Are you sure you want to delete it?');
                        if (!confirmed) {
                            e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>