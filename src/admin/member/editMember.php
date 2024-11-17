<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM members WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$member_name = isset($_GET['member_name']) ? $_GET['member_name'] : $row['member_name'];
$address = isset($_GET['address']) ? $_GET['address'] : $row['address'];
$contact = isset($_GET['contact']) ? $_GET['contact'] : $row['contact'];
$plan = isset($_GET['plan']) ? $_GET['plan'] : $row['plan'];
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
    <div class="edit-container">
        <div class="row1">
            <h1>Edit Member</h1>
            <a  href="members.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>
        
        <form action="../../../php/admin/member/editMember.php" method="POST">
        <div class="radio-tile-group">
            <div class="radio-tile">
                <input type="radio" id="plan1" name="plan" value="1 week" 
                <?php if ($plan == '1 week') echo 'checked'; ?> required>
                    <label for="plan1" class="plan-label">
                        <h3 class="plan-duration">1 week</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">100</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
            </div>
            <div class="radio-tile">
                <input type="radio" id="plan2" name="plan" value="1 month" 
                <?php if ($plan == '1 month') echo 'checked'; ?>>
                <label for="plan2" class="plan-label">
                    <h3 class="plan-duration">1 month</h3> 
                    <span class="plan-text">only for</span>
                    <h2 class="plan-price">200</h2>
                    <h3 class="plan-currency">pesos</h3>
                </label>
            </div>
            <div class="radio-tile">
                <input type="radio" id="plan3" name="plan" value="3 months" 
                <?php if ($plan == '3 months') echo 'checked'; ?>>
                <label for="plan3" class="plan-label">
                    <h3 class="plan-duration">3 months</h3> 
                    <span class="plan-text">for</span>
                    <h2 class="plan-price">500</h2>
                    <h3 class="plan-currency">pesos</h3>
                </label>
            </div>
        </div><br>

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <input type="text" name="member_name" value="<?php echo htmlspecialchars($member_name); ?>" required autocomplete="off"><br>

            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required autocomplete="off"><br>

            <input type="text" name="contact" value="<?php echo htmlspecialchars($contact); ?>" required autocomplete="off"><br>

            <button type="submit" class="green-button">Update Member</button>
        </form>

        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
