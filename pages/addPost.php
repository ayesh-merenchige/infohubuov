<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: adminLogin.php');
    exit();
}

$pageId = $_SESSION['admin'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../conf/dbconfig.php');

    $description = $_POST['description'];
    $image = $_FILES['image'];

    $postID = uniqid();

    $date = date('Y-m-d');
    $time = date('H:i:s');

    if ($image['size'] > 0) {
        $targetDir = '../assets/userImage/';
        $imageName = $postID . '_' . basename($image['name']);
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $sql = "INSERT INTO post (postID, description, date, time, image, pageID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('ssssss', $postID, $description, $date, $time, $imageName, $pageId);
                $stmt->execute();
                $stmt->close();
                $db->close();
                header('Location: adminDashboard.php');
                exit();
            } else {
                echo 'Error preparing SQL statement: ' . $db->error;
            }
        } else {
            echo 'Error uploading the image.';
        }
    } else {
        $sql = "INSERT INTO post (postID, description, date, time, pageID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('sssss', $postID, $description, $date, $time, $pageId);
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

    <title>Add New Post</title>
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
                    <label class="form-label">Add New Post</label> <br><br>
                    <label for="description">Description:</label> <br>
                    <textarea name="description" class="inputText inputTextArea" required rows=10></textarea> <br>
                    <label for="image">Image:</label> <br>
                    <input type="file" name="image" accept="image/*" class="inputText" onchange="previewImage(this)">
                    <img id="imagePreview" src="#" alt="Image Preview" class="prevImg">
                    <br>
                    <button type="submit" class="btn1">Add Post</button> <br>
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
