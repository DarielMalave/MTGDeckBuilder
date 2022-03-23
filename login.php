<?php require_once('templates/login_header.php'); ?>

<?php
    if (isset($_GET['register'])) {
        echo "<p>Registration successful!</p>";
    }

    if (isset($_GET['login'])) {
        echo "<p>Login successful!</p>";
    }
?>

<section id="container">
    <form method="POST" action="login_process.php">
        <div id="register_container">
            <h2>Log In</h2>
            <hr>
            <div>
                <label for="username">Enter username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="password">Enter password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit">Log In!</button>
            </div>
        </div>
    </form>

    <form method="POST" action="register_process.php">
        <div id="register_container">
            <h2>Register</h2>
            <hr>
            <div>
                <label for="username">Enter username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="password">Enter password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label for="reenter">Re-enter password:</label>
                <input type="password" name="reenter" required>
            </div>
            <div>
                <button type="submit">Register!</button>
            </div>
        </div>
    </form>
</section>

<?php require_once('templates/footer.php'); ?>