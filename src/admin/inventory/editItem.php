<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

if (isset($_GET['item_no'])) {
    $item_no = $_GET['item_no'];
    $sql = "SELECT * FROM inventory WHERE item_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $item_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "Item not found";
        exit();
    }
    $stmt->close();
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
    <div class="edit-container">
        <div class="row1">
            <h1>Edit Item</h1>
            <a href="inventory.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/admin/inventory/editItem.php">

        <input type="hidden" name="item_no" value="<?php echo htmlspecialchars($item['item_no']); ?>" required/>

            <input type="text" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" placeholder="Item Name" required autocomplete="off"/>
            <input type="number" name="price" value="<?php echo htmlspecialchars($item['price']); ?>" step="1.00" placeholder="Price" required/>
            <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" placeholder="Quantity" required/>
            <button type="submit" class="green-button">Update Item</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Item updated successfully!</p>
            <button onclick="window.location.href='inventory.php'" class="blue-button">Go to Inventory</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminEditItem.js"></script>
</body>
</html>
