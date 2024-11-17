<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gym System</title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
    <div class="header">
        <div class="logo" id="openModalBtn">
            Gym System
        </div>
        <nav>
            <a href="admin.php">Login as Admin</a>
        </nav>
    </div>

    <form method="POST" action="php/user/login.php" class="login-form">
    <h1>Login</h1>
        <input 
            type="text" 
            name="contact" 
            placeholder="Phone Number" 
            required 
            value="<?php echo isset($_SESSION['contact']) ? htmlspecialchars($_SESSION['contact']) : ''; ?>"
            autocomplete="off"
        />
        <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            required 
            value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>"
            autocomplete="off"
        />

        <?php if (isset($_SESSION['error'])): ?>
            <p><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?><br/>

        <button type="submit" class="blue-button">Login</button>
    </form>

    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <p>Admin Create User Account</p><br/>
            <button class="red-button">Close</button>
        </div>
    </div>

    <script src="asset/javascript/modal.js"></script>
</body>
</html>

<?php
unset($_SESSION['contact']);
unset($_SESSION['password']);
?>