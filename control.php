<?php
  session_start();
  include("connection/connection.php");
  if($_SESSION['user'] != null) {
    header("Location: securepage.php");
  }
  elseif($_SESSION['username'] == null && $_SESSION['password'] == null) {
    $conn = null;
    header("Location: index.php?process_type=error");
    exit();
  }
  else {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $check_user = $conn->prepare("SELECT * FROM users WHERE username=? AND pass=?;");
    $check_user->bindParam(1, $username, PDO::PARAM_STR);
    $check_user->bindParam(2, $password, PDO::PARAM_STR);
    $check_user->execute();
    if($check_user->rowCount() === 1) {
      // We get uniq number from user.
    }
    else {
      $conn = null;
      header("Location: index.php?process_type=nulluser");
      exit();
    }
  }
?>
<html lang="tr">
  <head>
    <meta charset="UTF-8"/>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@531&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Language" content="tr"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <meta name="robots" content="index, follow"/>
    <meta name="author" content="Mehmet Kıvanç ERBUDAK, Mert Furkan ERGÜDEN, Uğur KIZILKUŞ"/>
	  <meta http-equiv="copyright" content="Mehmet Kıvanç ERBUDAK, Mert Furkan ERGÜDEN, Uğur KIZILKUŞ"/>
	  <meta name="keywords" content=""/>
	  <meta name="description" content=""/>
    <meta name="viewport" content="width=1080, initial-scale=0">
    <link rel="shortcut icon" href="img/logo.ico">
    <title>Unicus Computer - Individual Solutions</title>
  </head>
  <body>
    <nav>
      <div id="area_1">
        <span style="color: white;">CENG 3544	Computer and Network Security</span>
        <div id="menu">
          <ul id=menu_bar>
            <a href="index.php"><li>Login</li></a>
            <a href="register.php"><li>Register</li></a>
          </ul>
        </div>
      </div>
    </nav>
    <header>
      <center>USER AUTHENTICATIONS METHODS FOR WEB APPLICATIONS</center>
    </header>
    <section>
      <h3>Login Page</h3>
      <div class="hr"></div>
      <br>
      <table align="center">
        <form action="path/login.php" method="POST">
          <tr>
            <td>Uniq Number: </td>
            <td><input type="text" name="uid"></td>
          </tr>
          <tr>
            <td></td>
            <td><button>Login</button></td>
          </tr>
        </form>
      </table>
      <br><br><br><br><br>
    </section>
    <footer>
      <div style="color: white; width: 1080px; margin: auto; height: 120px; line-height: 120px;">
        Mehmet Kıvanç ERBUDAK - Uğur KIZILKUŞ - Mert Furkan ERGÜDEN
      </div>
    </footer>
  </body>
</html>
