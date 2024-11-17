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
            <h1>Add Item</h1>
            <a href="inventory.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <form method="POST" action="../../../php/admin/inventory/addItem.php">

            <input type="text" name="item_no" placeholder="Item No." required autocomplete="off"/>
            <input type="text" name="item_name" placeholder="Item Name" required autocomplete="off"/>
            <input type="number" name="price" step="1.00" placeholder="Price" required/>
            <input type="number" name="quantity" placeholder="Quantity" required/>
            <button type="submit" class="green-button">Add Item</button>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Item added successfully!</p>
            <button onclick="window.location.href='inventory.php'" class="blue-button">Go to Inventory</button>
            <button onclick="closeModal()" class="red-button">Close</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminAddItem.js"></script>
</body>
</html>
