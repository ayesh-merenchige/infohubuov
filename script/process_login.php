<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enrolmentNum = $_POST['enrolmentNum'];
    $password = $_POST['password'];

    require_once('../conf/dbconfig.php');

    $sql = "SELECT * FROM Users WHERE enrolmentNum = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $enrolmentNum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: ../pages/newsfeed.php');
            exit();
        } else {
            echo '<script>
                    alert("Incorrect password. Please try again.");
                    window.location.href = "../login.php";
                  </script>';
        }
    } else {
        echo '<script>
                alert("User not found. Please check your enrolment number.");
                window.location.href = "../login.php";
              </script>';
    }

    $stmt->close();
    $db->close();
}
?>