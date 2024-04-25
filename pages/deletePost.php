<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
    exit();
}

$pageId = $_SESSION['admin'];

if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    require_once('../conf/dbconfig.php');

    $sql = "SELECT * FROM post WHERE postID = ? AND pageID = ?";
    $stmt = $db->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ss', $postID, $pageId);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo 'Error preparing SQL statement: ' . $db->error;
        exit();
    }

    $db->close();
} else {
    header('Location: adminDashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmDelete']) && $_POST['confirmDelete'] === 'true') {
        $db = new mysqli('localhost', 'root', '', 'uovinfohubdb');

        if ($db->connect_error) {
            die('Connection failed: ' . $db->connect_error);
        }

        $deleteSql = "DELETE FROM post WHERE postID = ? AND pageID = ?";
        $deleteStmt = $db->prepare($deleteSql);

        if ($deleteStmt) {
            $deleteStmt->bind_param('ss', $postID, $pageId);
            $deleteStmt->execute();
            $deleteStmt->close();
        } else {
            echo 'Error preparing SQL statement: ' . $db->error;
        }

        if (!empty($post['image'])) {
            $imagePath = '../assets/userImage/' . $post['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $db->close();

        header('Location: adminDashboard.php');
        exit();
    } else {
        header('Location: adminDashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <?php include_once("../style/fontIconConfig.html"); ?>
    <title>Delete Post</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("../script/header.html"); ?>
    </header>

    <main>
        <div class="table-container">
        <table class="news-feed-table">
        <td class="news-feed-table-td">
            <form method="post">
                <label class="form-label">Delete Post</label> <br><br>
                <p style="color: red;">Are you sure you want to delete this post?</p>
                <p>Description: <?= $post['description'] ?></p>
                <p>Date: <?= $post['date'] ?></p>
                <p>Time: <?= $post['time'] ?></p>
                <?php if ($post['image']) : ?>
                            <img src="../assets/userImage/<?php echo $post['image']; ?>" alt="Post Image" style="max-width: 300px; margin-top: 10px;"> <br>
                <?php endif; ?>
                <input type="hidden" name="confirmDelete" value="true">
                <input class="btn1" type="submit" value="Delete"></input>
                </form>

                <form>
                <button class="btn1" onclick="redirectToPage('../pages/adminDashboard.php')">Cancel</button>
                <form>
        </td>
        </table>
        </div>
    </main>
    <script src="../script/redirectToPage.js"></script>
</body>
</html>
