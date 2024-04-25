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
    $db = new mysqli('localhost', 'root', '', 'uovinfohubdb');

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    $description = $_POST['description'];

    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image'];
        $targetDir = '../assets/userImage/';
        $imageName = $postID . '_' . basename($image['name']);
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $sql = "UPDATE post SET description = ?, image = ? WHERE postID = ? AND pageID = ?";
            $stmt = $db->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('ssss', $description, $imageName, $postID, $pageId);
                $stmt->execute();
                $stmt->close();
                $db->close();
                header('Location: adminDashboard.php');
                exit();
            } else {
                echo 'Error preparing SQL statement: ' . $db->error;
            }
        } else {
            echo 'Error uploading the new image.';
        }
    } else {
        $sql = "UPDATE post SET description = ? WHERE postID = ? AND pageID = ?";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sss', $description, $postID, $pageId);
            $stmt->execute();
            $stmt->close();
            $db->close();
            header('Location: adminDashboard.php');
            exit();
        } else {
            echo 'Error preparing SQL statement: ' . $db->error;
        }
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
    <title>Update Post</title>
</head>
<body style="padding-top: 100px;">
    <header id="fixed-header">
        <?php include_once("../script/header.html"); ?>
    </header>

    <main>
        <div class="table-container">
        <table class="news-feed-table">
        <td class="news-feed-table-td">
            <form method="post" enctype="multipart/form-data">
                        <label class="form-label">Update Post</label> <br><br>
                        <label for="description">Description:</label> <br>
                        <textarea name="description" rows="4" class="inputText inputTextArea" required rows=10><?= $post['description'] ?></textarea> <br>
                        <label for="image">Image:</label> <br>
                        <input type="file" name="image" class="inputText" onchange="previewImage(this)"> <br>
                        <?php if ($post['image']) : ?>
                            <img id="imagePreview" src="<?= isset($post['image']) ? '../assets/userImage/' . $post['image'] : '#' ?>" alt="Image Preview" style="max-width: 300px; margin-top: 10px;"> <br>
                        <?php endif; ?>
                        <button type="submit" class="btn1">Update Post</button>
                        <button type="button" class="btn1" onclick="redirectToPage('../pages/adminDashboard.php')">Cancel</button>
            </form>
        </td>
        </table> 
        </div>
    </main>

    <script src="../script/redirectToPage.js"></script>
    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
