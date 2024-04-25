<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">
    <?php include_once("../style/fontIconConfig.html"); ?>

    <title>Admin Login</title>
</head>
<body>
    <header id="fixed-header">
        <?php include_once("../script/header.html"); ?>
    </header>
    
    <main>
        <div class="table-container">
            <table style="margin-top: 200px;">
                <tr>
                    <td>
                        <a href="../login.php" class="non-style-link">User Login</a>
                    </td>
                    <td>
                        <a href="signup.php" class="non-style-link">User SignUp</a>
                    </td>
                    <td class="selected-section">
                        Admin Login
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="body-td">
                        <form action="../script/admin_process_login.php" method="post">
                            <br>
                            <label class="form-label">Admin Login</label> <br>
                            <input type="text" placeholder="👨‍🏫 Page Id" name="pageId" class="inputText" required> <br>
                            <input type="password" placeholder="🔑 Password" name="password" class="inputText" required> <br>
                            <input class="btn1" type="submit" value="Login">
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
