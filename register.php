<?php
  session_start();
  include("connection/connection.php");
  if($_SESSION['user'] != null) {
    header("Location: securepage.php");
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
    <title>Implementation</title>
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
      <h3>Register Page</h3>
      <div class="hr"></div>
      <br>
      <table align="center">
        <form action="path/register.php" method="POST">
          <tr>
            <td>Username: </td>
            <td><input type="text" name="username"></td>
          </tr>
          <tr>
            <td>Password: </td>
            <td><input type="text" name="passwd"></td>
          </tr>
          <tr>
            <td>Name: </td>
            <td><input type="text" name="name"></td>
          </tr>
          <tr>
            <td>Mail: </td>
            <td><input type="text" name="mail"></td>
          </tr>
          <tr>
            <td></td>
            <td><button>Register</button></td>
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
