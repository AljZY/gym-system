<?php
include '../../../config/database.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../../admin.php");
    exit();
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';

$allowed_sort_columns = ['id', 'start_date', 'end_date', 'member_name', 'remaining_days'];
if (!in_array($sort_by, $allowed_sort_columns)) {
    $sort_by = 'id';
}

$sort_order = strtoupper($sort_order);
if ($sort_order !== 'ASC' && $sort_order !== 'DESC') {
    $sort_order = 'DESC';
}

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) FROM members WHERE member_name LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_members = $total_result->fetch_row()[0];
$total_pages = ceil($total_members / $limit);

$sql = "SELECT *, 
        DATEDIFF(end_date, CURDATE()) AS remaining_days 
        FROM members
        WHERE member_name LIKE '%$search%'
        ORDER BY $sort_by $sort_order
        LIMIT $limit OFFSET $offset
        ";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
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
    <div class="container">
        <div class="row1">
            <div class="card">
                <a href="addMembers.php" class="card-link">
                    <span class="card-icon">
                    <img src="../../../asset/icon/add-user.png" alt="Add Member" class="icon">
                    </span>    
                    Add Membership
                </a>
            </div>

            <form method="GET" action="" class="search">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Find name" 
                    value="<?php echo htmlspecialchars($search); ?>"
                    autocomplete="off" 
                />
                <button type="submit">
                    <img src="../../../asset/icon/search.png" alt="Search" class="icon">
                </button>
            </form>

            <a  href="../homepage.php" class="card-link">
                <span class="card-icon">
                <img src="../../../asset/icon/back.png" alt="Back" class="icon">
                </span>
            </a>
        </div>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&sort_by=<?php echo $sort_by; ?>&sort_order=<?php echo $sort_order; ?>&search=<?php echo htmlspecialchars($search); ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&sort_by=<?php echo $sort_by; ?>&sort_order=<?php echo $sort_order; ?>&search=<?php echo htmlspecialchars($search); ?>"<?php if ($i == $page) echo ' class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&sort_by=<?php echo $sort_by; ?>&sort_order=<?php echo $sort_order; ?>&search=<?php echo htmlspecialchars($search); ?>">Next</a>
                <?php endif; ?>
            </div>

            <table class="ten-cols">
                <thead>
                    <tr>
                        <th>Start Date<br/>
                            <button class="sort-btn">
                                <a href="?sort_by=start_date&sort_order=<?php echo ($sort_by == 'start_date' && $sort_order == 'ASC') ? 'DESC' : 'ASC'; ?>">Sort</a>
                            </button>
                        </th>
                        <th>End Date<br/>
                            <button class="sort-btn">
                                <a href="?sort_by=end_date&sort_order=<?php echo ($sort_by == 'end_date' && $sort_order == 'ASC') ? 'DESC' : 'ASC'; ?>">Sort</a>
                            </button>
                        </th>
                        <th>Member Name<br/>
                            <button class="sort-btn">
                                <a href="?sort_by=member_name&sort_order=<?php echo ($sort_by == 'member_name' && $sort_order == 'ASC') ? 'DESC' : 'ASC'; ?>">Sort</a>
                            </button>
                        </th>
                        <th>Address</th>
                        <th>Contact No.</th>
                        <th>Plan</th>
                        <th>Temporary Password</th>
                        <th>Remaining Days<br/>
                            <button class="sort-btn">
                                <a href="?sort_by=remaining_days&sort_order=<?php echo ($sort_by == 'remaining_days' && $sort_order == 'ASC') ? 'DESC' : 'ASC'; ?>">Sort</a>
                            </button>
                        </th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                            if ($row['remaining_days'] > 0) {
                                $status = "Ongoing";
                                $status_class = "status-ongoing";
                            } else {
                                $status = "Expired";
                                $status_class = "status-expired";
                            }
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['member_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td><?php echo htmlspecialchars($row['plan']); ?></td>
                            <td><?php echo htmlspecialchars($row['temp_password']); ?></td>
                            <td><?php echo htmlspecialchars($row['remaining_days']); ?></td>
                            <td class="<?php echo $status_class; ?>"><?php echo $status; ?></td>
                            <td>
                                <button class="blue-button"><a href="editMember.php?id=<?php echo $row['id']; ?>">Edit</a></button>
                                <button class="red-button" onclick="openModal('<?php echo $row['member_name']; ?>', '<?php echo $row['id']; ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php $conn->close(); ?>
    </div>


    <?php if (isset($_GET['success'])): ?>
        <div id="successModal" class="modal">
            <div class="modal-content">
                <p><?php echo htmlspecialchars($_GET['success']); ?></p>
                    <button onclick="closeSuccessModal()" class="red-button">Close</button>
            </div>
        </div>
        <script src="../../../asset/javascript/adminEditMember.js"></script>
    <?php endif; ?>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p id="modalMessage"></p>
            <button id="confirmDeleteButton" class="blue-button">Yes</button>
            <button id="cancelDeleteButton" onclick="closeModal()" class="red-button">No</button>
        </div>
    </div>

    <script src="../../../asset/javascript/adminDeleteMember.js"></script>
</body>
</html>
