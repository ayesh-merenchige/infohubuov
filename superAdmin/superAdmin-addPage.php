<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageID = $_POST['pageID'];
    $pageName = $_POST['pageName'];
    $password = $_POST['password'];

    require_once('../conf/dbconfig.php');

    $sql = 'INSERT INTO pageadmin (pageID, pageName, password) VALUES (?, ?, ?)';
    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sss', $pageID, $pageName, $password);
        $stmt->execute();
        $stmt->close();

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

    <title>Super Admin Add Page</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
    <?php include_once("script/header.html"); ?>
    </header>

    <main>
    <div class="table-container">
    <table class="news-feed-table">
    <td class="news-feed-table-td">
        <div class="table-container">
            <form id="add-page-form" action="" method="POST">
            <label class="form-label">Add New Page</label> <br><br>
                <label for="pageID">Page ID:</label> <br>
                <input type="text" name="pageID" class="inputText" required> <br>
                <label for="pageName">Page Name:</label> <br>
                <input type="text" name="pageName" class="inputText" required> <br>
                <label for="password">Password:</label> <br>
                <input type="test" name="password" class="inputText" required> <br>
                <input class="btn1" type="submit" value="Add Page"> <br>
                <button class="btn1" onclick="redirectToAdminDashboard()">Cancel</button>
            </form>
        </div>
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
