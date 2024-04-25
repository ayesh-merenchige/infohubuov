<?php

if (!isset($_GET['pageID'])) {
    header('Location: superAdmin-dashboard.php');
    exit();
}

$pageID = $_GET['pageID'];

require_once('../conf/dbconfig.php');

$sql = 'SELECT * FROM pageadmin WHERE pageID = ?';
$stmt = $db->prepare($sql);

if ($stmt) {
    $stmt->bind_param('s', $pageID);
    $stmt->execute();
    $result = $stmt->get_result();
    $pageadminData = $result->fetch_assoc();
    $stmt->close();
} else {
    die('Error preparing SQL statement: ' . $db->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteSql = 'DELETE FROM pageadmin WHERE pageID = ?';
    $deleteStmt = $db->prepare($deleteSql);

    if ($deleteStmt) {
        $deleteStmt->bind_param('s', $pageID);
        $deleteStmt->execute();
        $deleteStmt->close();

        header('Location: superAdmin-dashboard.php');
        exit();
    } else {
        die('Error preparing SQL statement: ' . $db->error);
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style.css">
    <?php include_once("style/fontIconConfig.html"); ?>
    <title>Super Admin Delete Page</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("script/header.html"); ?>
    </header>

    <main>
    <div class="table-container">
        <table class="news-feed-table">
        <td class="news-feed-table-td">
            <form id="delete-page-form" action="" method="POST">
                <label class="form-label">Delete Page</label> <br><br>
                <p style="color: red;">Are you sure you want to delete this page? <br> This action will delete all post belongs to this page !</p>
                <label for="pageID">Page ID:</label>
                <p><?php echo $pageadminData['pageID']; ?></p>
                <br>
                <label for="pageName">Page Name:</label>
                <p><?php echo $pageadminData['pageName']; ?></p>
                <br>
                <label for="password">Password:</label>
                <p><?php echo $pageadminData['password']; ?></p>
                <br>
                <input class="btn1" type="submit" value="Delete Page"> <br>
                <button type="button" class="btn1" onclick="redirectToAdminDashboard()">Cancel</button>
            </form>
        </td>
        </table>
    </div>
    </main>
    <script>
        function redirectToAdminDashboard() {
            window.location.href = 'superAdmin-dashboard.php';
        }
    </script>
</body>
</html>
