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
    $newPageName = $_POST['pageName'];
    $newPassword = $_POST['password'];

    $updateSql = 'UPDATE pageadmin SET pageName = ?, password = ? WHERE pageID = ?';
    $updateStmt = $db->prepare($updateSql);

    if ($updateStmt) {
        $updateStmt->bind_param('sss', $newPageName, $newPassword, $pageID);
        $updateStmt->execute();
        $updateStmt->close();

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
    <title>Super Admin Update Page</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("script/header.html"); ?>
    </header>

    <main>
    <div class="table-container">
        <table class="news-feed-table">
        <td class="news-feed-table-td">
            <form id="update-page-form" action="" method="POST">
                <label class="form-label">Update Page</label> <br><br>
                <label for="pageID">Page ID:</label> <br>
                <input type="text" name="pageID" class="inputText" value="<?php echo $pageadminData['pageID']; ?>" readonly>
                <br>
                <label for="pageName">Page Name:</label> <br>
                <input type="text" name="pageName" class="inputText" value="<?php echo $pageadminData['pageName']; ?>" required>
                <br>
                <label for="password">Password:</label> <br>
                <input type="text" name="password" class="inputText" value="<?php echo $pageadminData['password']; ?>" required>
                <br>
                <input class="btn1" type="submit" value="Update Page"> <br>
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
