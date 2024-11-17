<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$start_date = '';
$end_date = '';
$total_amount = 0;
$overall_total = 0;
$payments = [];

$sql = "SELECT SUM(amount) AS overall_total FROM payment";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $overall_total = $row['overall_total'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "SELECT * FROM payment WHERE payment_date BETWEEN ? AND ? ORDER BY payment_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $total_amount += $row["amount"];
        $payments[] = $row;
    }

    $stmt->close();
} else {
    $sql = "SELECT * FROM payment ORDER BY payment_date DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $payments[] = $row;
    }
}

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
    <div class="container">
        <div class="row1">
            <div class="card">
                <a href="addPayment.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../../asset/icon/money.png" alt="Add Payment" class="icon">
                    </span>    
                    Add Payment
                </a>
            </div>

            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>
        
        <div class="total-amount-box">Overall Total Amount of All Payments: <span class="amount"><?php echo $overall_total; ?></span>Pesos</div>

        <div class="row2">
            <form method="POST">
                Compute overall payment for specific date<br/><br/>
                <label>
                    Start Date
                    <input type="date" name="start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>" required />
                </label>
                <label>
                    End Date
                    <input type="date" name="end_date" value="<?php echo isset($end_date) ? $end_date : ''; ?>" required />
                </label>
                <button type="submit" name="compute" class="green-button">Submit</button>
                Total Amount: <?php echo $total_amount; ?>
            </form>
        </div>

        <table class="five-cols">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Plan</th>
                    <th>Amount (Pesos)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (count($payments) > 0) {
                foreach ($payments as $row) {
                    echo "<tr>
                            <td>" . $row["payment_date"] . "</td>
                            <td>" . $row["name_or_alias"] . "</td>
                            <td>" . $row["plan"] . "</td>
                            <td>" . $row["amount"] . "</td>
                            <td>
                                <button onclick=\"window.location.href='editPayment.php?id=" . $row['id'] . "'\" class=\"blue-button\">Edit</button>
                                <button onclick=\"showModal(" . $row['id'] . ")\" class=\"red-button\">Delete</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No payments found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this payment?</p>
            <button id="confirmDelete" onclick="confirmDelete()" class="blue-button">Confirm</button>
            <button onclick="hideModal()" class="red-button">Cancel</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminDeletePayment.js"></script>
</body>
</html>
