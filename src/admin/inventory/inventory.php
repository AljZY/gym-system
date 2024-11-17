<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$sql = "SELECT * FROM inventory ORDER BY date_added DESC";
$result = $conn->query($sql);

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
                <a href="addItem.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../../asset/icon/list.png" alt="Add Item" class="icon">
                    </span>    
                    Add Item
                </a>
            </div>
            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

        <table class="six-cols">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item No.</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['date_added'] . "</td>
                            <td>" . $row['item_no'] . "</td>
                            <td>" . $row['item_name'] . "</td>
                            <td>" . $row['price'] . "</td>
                            <td>" . $row['quantity'] . "</td>
                            <td>
                                <button onclick=\"window.location.href='editItem.php?item_no=" . $row['item_no'] . "'\" class=\"blue-button\">Edit</button>
                                <button onclick=\"showDeleteModal('" . $row['item_no'] . "')\" class=\"red-button\">Delete</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>Are you sure you want to delete this item?</p>
            <form id="deleteForm" method="POST" action="../../../php/admin/inventory/deleteItem.php">
                <input type="hidden" name="item_no" id="itemNoToDelete" />
                <button type="submit" class="blue-button">Confirm</button>
                <button type="button" onclick="closeDeleteModal()" class="red-button">Cancel</button>
            </form>
        </div>
    </div>

    <script src="../../../asset/javascript/adminDeleteItem.js"></script>
</body>
</html>
