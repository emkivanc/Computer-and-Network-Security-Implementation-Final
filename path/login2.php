<?php
    session_start();
    include("../connection/connection.php");
    if($_SESSION['user'] != null) {
        $conn = null;
        header("Location: ../securepage.php");
        exit();
    }
    else {
        if($_GET['qrcode'] == null) {
            $conn = null;
            header("Location: ../index.php");
            exit();
        }
        else {
            $code = htmlspecialchars(strip_tags(trim($_GET['qrcode'])), ENT_QUOTES);
            if(preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $code)) {
                $conn = null;
                header("Location: ../index.php");
                exit();
            }
            else {
                $checkcode = $conn->prepare("SELECT * FROM users WHERE qrlogin=?;");
                $checkcode->bindParam(1, $code, PDO::PARAM_STR);
                $checkcode->execute();
                if($checkcode->rowCount() === 1) {
                    $user = $checkcode->fetch(PDO::FETCH_ASSOC);
                    $username = $user['username'];
                    $_SESSION['user'] = $username;
                    $_SESSION['username'] = $username;
                    $nullvalue = "";
                    $qrlogindelete = $conn->query("UPDATE users SET qrlogin='$nullvalue' WHERE username='$username';");
                    $conn = null;
                    header("Location: ../securepage.php");
                    exit();
                }
                else {
                    $conn = null;
                    header("Location: ../index.php");
                    exit();
                }
            }
        }
    }
?>