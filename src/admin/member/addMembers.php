<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym System</title>
    <link rel="stylesheet" href="../../../asset/style.css">
</head>
<body>
    <div class="add-container">
        <div class="row1">
            <h1>Add Membership</h1>
            <a  href="members.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form action="../../../php/admin/member/addMember.php" method="POST">

        <div class="radio-tile-group">
            <div class="radio-tile">
                <input type="radio" id="plan1" name="plan" value="1 week" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '1 week') echo 'checked'; ?> required>
                    <label for="plan1" class="plan-label">
                        <h3 class="plan-duration">1 week</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">100</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
            </div>
            <div class="radio-tile">
                <input type="radio" id="plan2" name="plan" value="1 month" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '1 month') echo 'checked'; ?>>
                <label for="plan2" class="plan-label">
                    <h3 class="plan-duration">1 month</h3> 
                    <span class="plan-text">only for</span>
                    <h2 class="plan-price">200</h2>
                    <h3 class="plan-currency">pesos</h3>
                </label>
            </div>
            <div class="radio-tile">
                <input type="radio" id="plan3" name="plan" value="3 months" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '3 months') echo 'checked'; ?>>
                <label for="plan3" class="plan-label">
                    <h3 class="plan-duration">3 months</h3> 
                    <span class="plan-text">for</span>
                    <h2 class="plan-price">500</h2>
                    <h3 class="plan-currency">pesos</h3>
                </label>
            </div>
        </div><br>
        
            <input type="text" name="member_name" placeholder="Member Name" 
                value="<?php echo isset($_GET['member_name']) ? htmlspecialchars($_GET['member_name']) : ''; ?>" required autocomplete="off"><br/>

            <input type="text" name="address" placeholder="Address" 
                value="<?php echo isset($_GET['address']) ? htmlspecialchars($_GET['address']) : ''; ?>" required autocomplete="off"><br/>

            <input type="text" name="contact" placeholder="Contact No." 
                value="<?php echo isset($_GET['contact']) ? htmlspecialchars($_GET['contact']) : ''; ?>" required autocomplete="off"><br/>
                
            <button type="submit" class="green-button">Add Member</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content">
            <p><?php echo isset($_GET['success']) ? htmlspecialchars($_GET['success']) : ''; ?></p>
            <button onclick="redirectToMembers()" class="blue-button">Go to Members</button>
            <button onclick="closeModal()" class="red-button">Close</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminAddMember.js"></script>
</body>
</html>
