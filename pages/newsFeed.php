<?php
session_start();

if (isset($_SESSION['user'])) {

    $user = $_SESSION['user'];
    $subList = $user['subList'];

    require_once('../conf/dbconfig.php');

    $subscribedPages = explode(',', $subList);

    $posts = [];
    foreach ($subscribedPages as $pageID) {
        $sql = "SELECT postID,description,date,time,image,post.pageID,pageName FROM Post LEFT JOIN pageadmin ON post.pageID=pageadmin.pageID WHERE post.pageID = ?;";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $pageID);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }

            $stmt->close();
        } else {
            die('Error preparing SQL statement: ' . $db->error);
        }
    }

    $db->close();
} else {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">
    <?php include_once("../style/fontIconConfig.html"); ?>
    <title>News Feed</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("../script/header.html"); ?>
        
        <div class="dropdown" id="dropdown">
            <i class="fas fa-bars" style="font-size: 24px; cursor: pointer;"></i>
            <div class="dropdown-content" id="dropdown-content">
                <a href="subscribeSetting.php">Subscribe Setting</a>
                <a href="../script/process_logout.php">Logout</a>
                <a href="#">About</a>
            </div>
        </div>
        <script src="../script/dropdownMenuScript.js"></script>
    </header>

    <?php
    if ($subscribedPages[0]==null) {
        echo '<div class="table-container">';
        echo '<table class="news-feed-table">';
        echo '<tr>';
        echo '<td colspan=2 class=news-feed-table-td>';
        echo '<div class="message">You have not subscribed to any pages. Please go to Subscribe Setting to subscribe. <br><br> <a href=subscribeSetting.php>🔗 Subscribe Setting</a> </div>';
        echo '</td>';
        echo '</table>';
        echo '</div>';
    } elseif (empty($posts)) {
        echo '<div class="table-container">';
        echo '<table class="news-feed-table">';
        echo '<tr>';
        echo '<td colspan=2 class=news-feed-table-td>';
        echo '<div class="message">No posts to display from your subscribed pages.</div>';
        echo '</td>';
        echo '</table>';
        echo '</div>';
    } else {
        foreach ($posts as $post) {
            echo '<div class="table-container">';
            echo '<table class="news-feed-table">';
            echo '<tr>';
            echo '<td width=75% class=news-feed-table-td-head>' . $post['pageName'] . '</td>';
            echo '<td width=25% class=news-feed-table-td-head style=font-size:10px;font-weight:300;>' . $post['date'] . '<br>' . $post['time'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan=2 class=news-feed-table-td>' . $post['description'] . '</td>';
            echo '</tr>';
            if ($post['image']) {
                echo '<tr>';
                echo '<td colspan=2 class=news-feed-table-td> <img src=../assets/userImage/' . $post['image'] . ' width=100%></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
        }
    }
    ?>
</body>
</html>
