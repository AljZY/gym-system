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
            <h1>Add Payment</h1>
            <a href="payment.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form action="../../../php/admin/payment/addPayment.php" method="POST">

        <div class="row1">
            <input type="date" name="payment_date"  id="paymentDate"/>
            
            <input type="text" name="name_or_alias" placeholder="Name" required autocomplete="off"/>
        </div><br/>

            <div class="radio-tile-group">
                <div class="radio-tile">
                    <input type="radio" id="plan1" name="plan" value="1 day" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '1 day') echo 'checked'; ?> required>
                    <label for="plan1" class="plan-label">
                        <h3 class="plan-duration">1 day</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">30</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan2" name="plan" value="1 week" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '1 week') echo 'checked'; ?> required>
                    <label for="plan2" class="plan-label">
                        <h3 class="plan-duration">1 week</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">100</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan3" name="plan" value="1 month" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '1 month') echo 'checked'; ?> required>
                    <label for="plan3" class="plan-label">
                        <h3 class="plan-duration">1 month</h3> 
                        <span class="plan-text">only for</span>
                        <h2 class="plan-price">200</h2>
                        <h3 class="plan-currency">pesos</h3>
                    </label>
                </div>

                <div class="radio-tile">
                    <input type="radio" id="plan4" name="plan" value="3 months" 
                    <?php if (isset($_GET['plan']) && $_GET['plan'] == '3 months') echo 'checked'; ?> required>
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
                <span id="amount-text" class="amount">0.00</span> pesos
            </div>
            <input type="hidden" id="amount" name="amount" />
            
            <button type="submit" class="green-button">Add Payment</button>
        </form>
    </div>

    <script src="../../../asset/javascript/adminAddPayment.js"></script>
</body>
</html>