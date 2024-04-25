<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

$user = $_SESSION['user'];
$subList = $user['subList'];

require_once('../conf/dbconfig.php');

$sqlPages = "SELECT * FROM pageadmin";
$resultPages = $db->query($sqlPages);

$subscribedPages = explode(',', $subList);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedPages = isset($_POST['pages']) ? $_POST['pages'] : [];
    $newSubList = implode(',', $selectedPages);

    $updateSql = "UPDATE Users SET subList = ? WHERE enrolmentNum = ?";
    $updateStmt = $db->prepare($updateSql);

    if ($updateStmt) {
        $updateStmt->bind_param('ss', $newSubList, $user['enrolmentNum']);
        $updateStmt->execute();
        $updateStmt->close();

        $_SESSION['user']['subList'] = $newSubList;

        echo $_SESSION['user']['subList'];

        header('Location: newsFeed.php');
        exit();
    } else {
        die('Error preparing SQL statement: ' . $db->error);
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <?php include_once("../style/fontIconConfig.html"); ?>
    <title>Subscribe Setting</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("../script/header.html"); ?>
    </header>

    <main>
        <div class="subscribe-container">
            <h2 class="table-container">Subscribe Setting</h2>
            <form method="post" action="subscribeSetting.php" class="subscribeForm">
                <?php
                echo "<table class=table-container>";
                while ($row = $resultPages->fetch_assoc()) {
                    $checked = in_array($row['pageID'], $subscribedPages) ? 'checked' : '';
                    echo "<tr><td>";
                    echo '<input type="checkbox" name="pages[]" value="' . $row['pageID'] . '" ' . $checked . '>';
                    echo "</td>";
                    echo "<td>";
                    echo $row['pageName'] . '<br>';
                    echo "</td></tr>";
                }
                echo "</table>";
                ?>
                
                <button class="btn1" type="submit">Update Subscribe List</button>
                <button class="btn1" type="button" onclick="redirectToNewsFeed()">Back to News Feed</button>
            </form>
        </div>
    </main>

    <script>
    function redirectToNewsFeed() {
        window.location.href = 'newsFeed.php';
    }
    </script>
</body>
</html>
