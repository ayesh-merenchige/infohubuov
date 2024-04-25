<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
    exit();
}

$pageId = $_SESSION['admin'];

require_once('../conf/dbconfig.php');

$sql = "SELECT * FROM post WHERE pageID = ? ORDER BY date DESC, time DESC";
$stmt = $db->prepare($sql);
$stmt->bind_param('s', $pageId);
$stmt->execute();
$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$stmt->close();
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php include_once("../style/fontIconConfig.html"); ?>

    <title>Admin Dashboard</title>
</head>
<body>
<header id="fixed-header">
    <?php include_once("../script/header.html"); ?>

        <div class="dropdown" id="dropdown">
            <i class="fas fa-bars" style="font-size: 24px; cursor: pointer;"></i>
            <div class="dropdown-content" id="dropdown-content">
                <a href="../script/process_logout.php">Logout</a>
                <a href="#">About</a>
            </div>
        </div>
        <script src="../script/dropdownMenuScript.js"></script>
    </header>

    <main>
        <div class="dashboard-container">
            <div  class="table-container">
                <table class="news-feed-table">
                <tr>
                    <td class="news-feed-table-td">
                        <button class="btn1" onclick="location.href='addPost.php'">Add New Post ➕</button>
                    </td>
                </tr>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                    <td class="news-feed-table-td">
                        <p><strong>Description:</strong> <?php echo $post['description']; ?></p>
                        <p><strong>Date:</strong> <?php echo $post['date']; ?></p>
                        <p><strong>Time:</strong> <?php echo $post['time']; ?></p>
                        <?php if ($post['image']) : ?>
                            <img src="../assets/userImage/<?php echo $post['image']; ?>" alt="Post Image" style="max-width: 100%;">
                        <?php endif; ?>
                        <br>
                        <button class="btn1" onclick="location.href='updatePost.php?postID=<?= $post['postID'] ?>'">Update Post</button>
                        <button class="btn1" onclick="location.href='deletePost.php?postID=<?= $post['postID'] ?>'">Delete Post</button>
                    </td>
                    <tr>
                <?php endforeach; ?>
            </div>

        </div>
    </main>
</body>
</html>
