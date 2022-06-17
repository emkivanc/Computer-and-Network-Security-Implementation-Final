<?php
  session_start();
  include("connection/connection.php");
  if($_SESSION['user'] == null) {
    header("Location: index.php");
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
            <a href="path/exit.php"><li>Exit</li></a>
          </ul>
        </div>
      </div>
    </nav>
    <header>
      <center>USER AUTHENTICATIONS METHODS FOR WEB APPLICATIONS</center>
    </header>
    <section>
      <h3>Secure Page</h3>
      <div class="hr"></div>
      <br>
      This is Secure Page.
      <?php
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        function qrCode($s, $w = 250, $h = 250){
          $u = 'https://chart.googleapis.com/chart?chs=%dx%d&cht=qr&chl=%s';
          $url = sprintf($u, $w, $h, $s);
            return $url;
        }
        $uniqdmg = uniqid();
        $qrlogincode = md5($username.$uniqdmg);
        $qrdata = "http://192.168.1.6:8888/Computer%20Network%20and%20Security%20Imp/path/login2.php?qrcode=".$qrlogincode;
        $qrlogincreator = $conn->query("UPDATE users SET qrlogin='$qrlogincode' WHERE username='$username' AND pass='$password';");
        $qr = qrCode($qrdata, 200, 200); // 200x200
      ?>
      <br><br>
      <?php echo "Welcome back, ". $username; ?> <br><br><br><br>
      You can use for easy login in your smartphone. <br>
      <img src="<?php echo $qr; ?>">
      <br><br><br>
    </section>
    <footer>
      <div style="color: white; width: 1080px; margin: auto; height: 120px; line-height: 120px;">
        Mehmet Kıvanç ERBUDAK - Uğur KIZILKUŞ - Mert Furkan ERGÜDEN
      </div>
    </footer>
  </body>
</html>
