<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageId = $_POST['pageId'];
    $password = $_POST['password'];

    require_once('../conf/dbconfig.php');

    $sql = "SELECT * FROM pageadmin WHERE pageId = ? AND password = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ss', $pageId, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        session_start();
        $_SESSION['admin'] = $pageId;
        header('Location: ../pages/adminDashboard.php');
        exit();
    } else {
        echo '<script>
                alert("Invalid Page Id or Password. Please try again.");
                window.location.href = "../pages/adminLogin.php";
              </script>';
    }

    $stmt->close();
    $db->close();
}
?>
