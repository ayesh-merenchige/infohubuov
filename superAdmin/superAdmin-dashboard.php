<?php

session_start();

if (!isset($_SESSION['super_admin'])) {
    header('Location: superAdmin-login.php');
    exit();
}

require_once('../conf/dbconfig.php');

$sql = 'SELECT * FROM pageadmin';
$result = $db->query($sql);

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style.css">
    <?php include_once("style/fontIconConfig.html"); ?>
    <title>Super Admin Dashboard</title>
</head>
<body>
    <header id="fixed-header">
        <?php include_once("script/header.html"); ?>

        <div class="dropdown" id="dropdown">
            <i class="fas fa-bars" style="font-size: 24px; cursor: pointer;"></i>
            <div class="dropdown-content" id="dropdown-content">
                <a href="superAdmin-logout.php">Logout</a>
                <a href="../login.php">Logout & Login as Normal User</a>
            </div>
        </div>

        <script src="../script/dropdownMenuScript.js"></script>
    </header>

    <main>
    <div class="dashboard-container">
        <div class="table-container">
            <table>
                <tr>
                    <th>Page ID</th>
                    <th>Page Name</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['pageID'] . '</td>';
                    echo '<td>' . $row['pageName'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>';
                    echo '<a href="superAdmin-updatePage.php?pageID=' . $row['pageID'] . '">Update</a>';
                    echo ' | ';
                    echo '<a href="superAdmin-deletePage.php?pageID=' . $row['pageID'] . '">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <br>
            
        </div>
        <div class="table-container">
        <button class="btn1" onclick="location.href='superAdmin-addPage.php'">Add New Page ➕</button>
        </div>
    <div class="dashboard-container">
    
    </main>
</body>
</html>
