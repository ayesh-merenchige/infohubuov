<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $enrolmentNum = $_POST['enrolmentNum'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    require_once('../conf/dbconfig.php');


    $check_sql = "SELECT enrolmentNum FROM Users WHERE enrolmentNum = ?";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->bind_param('s', $enrolmentNum);
    $check_stmt->execute();
    $check_stmt->store_result();


    if ($check_stmt->num_rows > 0) {
        echo '<script>
                alert("This Enrolment number already has an account.");
                window.location.href = "../pages/signup.php"; // Redirect to signup page or any other appropriate action
              </script>';
    } else {
        $insert_sql = "INSERT INTO Users (enrolmentNum, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $db->prepare($insert_sql);
        $insert_stmt->bind_param('sss', $enrolmentNum, $email, $password);

        if ($insert_stmt->execute()) {
            echo '<script>
                    alert("Registration successful! Now you can login!");
                    window.location.href = "../login.php";
                  </script>';
        } else {
            echo 'Error: ' . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $check_stmt->close();
    $db->close();
}
?>