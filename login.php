<?php require_once('templates/login_header.php'); ?>

<?php
    if (isset($_GET['register'])) {
        echo "<p>Registration successful!";
    }
?>

<section id="container">
    <form method="POST" action="register.php">
        <div id="register_container">
            <h2>Log In</h2>
            <hr>
            <div>
                <label for="username">Enter username:</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password">Enter password:</label>
                <input type="password" name="password">
            </div>
            <div>
                <button type="submit">Log In!</button>
            </div>
        </div>
    </form>

    <form method="POST" action="register.php">
        <div id="register_container">
            <h2>Register</h2>
            <hr>
            <div>
                <label for="username">Enter username:</label>
                <input type="text" name="username">
            </div>
            <div>
                <label for="password">Enter password:</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="reenter">Re-enter password:</label>
                <input type="password" name="reenter">
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>
</section>

<?php require_once('templates/footer.php'); ?>