<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/style.css">
    <?php include_once("../style/fontIconConfig.html"); ?>
    <title>UOV INFO HUB</title>
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
                <a href="../login.php" class="non-style-link">
                    User Login
                </a> 
            </td>
              <td class="selected-section">
                User SignUp
            </td>
              <td>
                <a href="adminLogin.php" class="non-style-link">
                    Admin Login
                </a>
            </td>
            </tr>
            <tr>
              <td colspan="3" class="body-td">
                <form id="signup-form" method="POST" action="../script/process_signup.php">
                  <br>
                  <label class="form-label">User Signup</label> <br>
                  <input type="text" name="enrolmentNum" placeholder="👨‍🏫 Enrolment Number" class="inputText"> <br>
                  <input type="email" name="email" placeholder="📧 e-mail" class="inputText"> <br>
                  <input type="password" name="password" placeholder="🔑 Password" class="inputText"> <br>
                  <input type="password" name="passwordRe" placeholder="🔑 re enter password" class="inputText"> <br>
                  <input class="btn1" name="signupBtn" type="submit" value="Signup">
                </form>
              </td>
            </tr>
          </table>
        </div>
      </main>

      <script>
          document.getElementById('signup-form').addEventListener('submit', function(event) {
          const enrolmentNum = document.getElementsByName('enrolmentNum')[0].value;
          const email = document.getElementsByName('email')[0].value;
          const password = document.getElementsByName('password')[0].value;
          const passwordRe = document.getElementsByName('passwordRe')[0].value;

          if (enrolmentNum.trim() === '' || email.trim() === '' || password.trim() === '' || passwordRe.trim() === '') {
            alert('All fields are required.');
            event.preventDefault();
          } else if (enrolmentNum.includes(' ')) {
            alert('Enrolment Number cannot contain spaces.');
            event.preventDefault();
          } else if (password !== passwordRe) {
            alert('Passwords do not match.');
            event.preventDefault();
          }
        });

      </script> 
</body>
</html>