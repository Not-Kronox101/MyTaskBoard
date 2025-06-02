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
                        justify-content: center;
                        align-items: center;
                }

                h1 {
                        font-weight: 700;
                        font-size: 2.5rem;
                        letter-spacing: 2px;
                        margin-bottom: 2rem;
                        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
                }

                form {
                        background: rgba(255, 255, 255, 0.1);
                        padding: 2rem;
                        border-radius: 15px;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
                        width: 100%;
                        max-width: 400px;
                        display: flex;
                        flex-direction: column;
                }

                input[type="text"],
                input[type="password"] {
                        padding: 0.8rem 1rem;
                        margin-bottom: 1rem;
                        border-radius: 25px;
                        border: none;
                        font-size: 1rem;
                        outline: none;
                        transition: box-shadow 0.3s ease;
                }

                input[type="text"]:focus,
                input[type="password"]:focus {
                        box-shadow: 0 0 10px 2px #ffd700;
                }

                button[type="submit"] {
                        background: #ffd700;
                        border: none;
                        padding: 0.8rem 1rem;
                        border-radius: 25px;
                        font-weight: 700;
                        cursor: pointer;
                        color: #333;
                        font-size: 1.2rem;
                        transition: background-color 0.3s ease;
                }

                button[type="submit"]:hover {
                        background: #ffbf00;
                }

                .error-message {
                        margin-bottom: 1rem;
                        padding: 0.5rem 1rem;
                        background: rgba(255, 0, 0, 0.7);
                        border-radius: 10px;
                        font-weight: 600;
                        text-align: center;
                        box-shadow: 0 0 5px rgba(255, 0, 0, 0.7);
                }
        </style>
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