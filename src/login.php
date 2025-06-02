<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if ($username === '') {
                $errorMessage = "Username is required.";
                exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['user_id'];
                header('Location: index.php');
                exit();
        } else {
                $errorMessage = 'Login failed: Incorrect username or password.';
        }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
        <meta charset="UTF-8" />
        <title>Login - Todo App</title>
</head>

<body>
        <h1>Todo App Login</h1>

        <?php if (!empty($errorMessage)): ?>
                <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
                <input type="text" name="username" required placeholder="Username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" />
                <input type="password" name="password" required placeholder="Password" />
                <button type="submit">Login</button>
        </form>
</body>

</html>