<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if ($userName === 'superadmin' && $password === 'super1234') {
        
        session_start();
        $_SESSION['super_admin'] = true;

        header('Location: superAdmin-dashboard.php');
        exit();
    } else {
        echo '<script>alert("Incorrect username or password.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/style.css">
    <?php include_once("style/fontIconConfig.html"); ?>
    <title>Super Admin Login</title>
</head>
<body>
    <header id="fixed-header">
        <?php include_once("script/header.html"); ?>
    </header>

    <main>
        <div class="table-container">
            <table style="margin-top: 200px;">
                <tr>
                    <td class="selected-section">
                        Super Admin Login
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="body-td">
                        <form id="login-form" action="" method="POST">
                            <br>
                            <label class="form-label">Super Admin Login</label> <br>
                            <input type="text" name="userName" placeholder="👨‍🏫 Enrolment Number" class="inputText"> <br>
                            <input type="password" name="password" placeholder="🔑 Password" class="inputText"> <br>
                            <input class="btn1" type="submit" value="Login">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
