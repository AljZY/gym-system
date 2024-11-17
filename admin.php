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
            <a href="index.php">Login as Member</a>
        </nav>
    </div>

    <form action="php/admin/login.php" method="POST" class="login-form">
    <h1>Login</h1>
        <input 
            type="email" 
            name="email" 
            placeholder="Email" 
            autocomplete="off"
            required 
            value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>" 
            autocomplete="off"
        />
        <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            autocomplete="off"
            required 
            value="<?php echo isset($_GET['password']) ? htmlspecialchars($_GET['password']) : ''; ?>"
            autocomplete="off" 
        />

        <?php if (isset($_GET['error'])): ?>
            <p><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?><br/>

        <button type="submit" class="blue-button">Login</button>
    </form>

    <div id="simpleModal" class="modal">
        <div class="modal-content">
            <p>
                email: admin@gym.com<br/>
                password: admin<br/>
                This message is for demo only!
            </p><br/>
            <button class="red-button">Close</button>
        </div>
    </div>

    <script src="asset/javascript/modal.js"></script>
</body>
</html>
