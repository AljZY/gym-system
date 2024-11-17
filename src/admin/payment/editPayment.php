<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
};

$payment_id = $_GET['id'];

$sql = "SELECT * FROM payment WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $payment = $result->fetch_assoc();
} else {
    echo "Payment not found";
    exit();
}

$stmt->close();
$conn->close();
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
            <h1>Edit Payment</h1>
            <a href="payment.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>
        
        <form action="../../../php/admin/payment/editPayment.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $payment['id']; ?>" />

            <div class="row1">
                <input type="date" name="payment_date" value="<?php echo $payment['payment_date']; ?>" required />
    
                <input type="text" name="name_or_alias" value="<?php echo $payment['name_or_alias']; ?>" required autocapitalize="off"/>
            </div>

            <div class="radio-tile-group">
                <div class="radio-tile">
                    <input type="radio" id="plan1" name="plan" value="1 day" 
                    <?php echo ($payment['plan'] == '1 day') ? 'checked' : ''; ?> required />
                    <label for="plan1" class="plan-label">
                        <h3 class="plan-duration">1 day</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">30</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan2" name="plan" value="1 week" 
                    <?php echo ($payment['plan'] == '1 week') ? 'checked' : ''; ?> required>
                    <label for="plan2" class="plan-label">
                        <h3 class="plan-duration">1 week</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">100</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan3" name="plan" value="1 month" 
                    <?php echo ($payment['plan'] == '1 month') ? 'checked' : ''; ?> required>
                    <label for="plan3" class="plan-label">
                        <h3 class="plan-duration">1 month</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">200</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan4" name="plan" value="3 months" 
                    <?php echo ($payment['plan'] == '3 months') ? 'checked' : ''; ?> required>
                    <label for="plan4" class="plan-label">
                        <h3 class="plan-duration">3 months</h3> 
                        <span class="plan-text">for</span>
                        <h2 class="plan-price">500</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>
            </div><br/>

            <div class="total-amount-box">
                Amount: 
                <span id="amount-text" class="amount"><?php echo $payment['amount']; ?></span> pesos
            </div>
            <input type="hidden" id="amount" name="amount" />

            <button type="submit" class="green-button">Update Payment</button>
        </form>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content">
            <p>Payment updated successfully!</p>
            <button onclick="window.location.href='payment.php'" class="blue-button">Go to Payment Page</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminEditPayment.js"></script>
</body>
</html>
