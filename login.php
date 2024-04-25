<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <?php include_once("style/fontIconConfig.html"); ?>

    <title>UOV INFO HUB</title>
</head>
<body>
    <header id="fixed-header">
        <div class="logo">
          <img src="assets/sysAssets/vavniyaUniLogo.png" alt="UOV INFO HUB Logo">
        </div>
        <div class="header-text">
          UOV INFO HUB
        </div>
      </header>
      
      <main>
        <div class="table-container">
          <table style="margin-top: 200px;">
            <tr>
              <td class="selected-section">
                User Login
              </td>
              <td>
                <a href="pages/signup.php" class="non-style-link">
                  User SignUp
                </a>
              </td>
              <td>
                <a href="pages/adminLogin.php" class="non-style-link">
                  Admin Login
                </a>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="body-td">
                <form id="login-form" action="script/process_login.php" method="POST">
                  <br>
                  <label class="form-label">User Login</label> <br>
                  <input type="text" name="enrolmentNum" placeholder="👨‍🏫 Enrolment Number" class="inputText"> <br>
                  <input type="password" name="password" placeholder="🔑 Password" class="inputText"> <br>
                  <input class="btn1" type="submit" value="Logging">
                </form>
              </td>
            </tr>
          </table>
        </div>
      </main>
</body>
</html>