<?php
    session_start();
    include("../connection/connection.php");
    require_once("class.phpmailer.php");
    if($_SESSION['user'] != null) {
        $conn = null;
        header("Location: ../securepage.php");
        exit();
    }
    else {
        if($_SESSION['username'] == null || $_SESSION['password'] == null) {
            $conn = null;
            header("Location: ../index.php");
            exit();
        }
        else {
            if($_POST['uid'] == null) {
                $conn = null;
                header("Location: ../index.php");
                session_destroy();
                exit();
            }
            else {
                $id = htmlspecialchars(strip_tags(trim($_POST['uid'])), ENT_QUOTES);
                if(preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $id)) {
                    $conn = null;
                    header("Location: ../index.php");
                    exit();
                }
                else {
                    $username = $_SESSION['username'];
                    $password = $_SESSION['password'];
                    $user_check = $conn->prepare("SELECT * FROM users WHERE username=? AND pass=? AND uniq=?;");
                    $user_check->bindParam(1, $username, PDO::PARAM_STR);
                    $user_check->bindParam(2, $password, PDO::PARAM_STR);
                    $user_check->bindParam(3, $id, PDO::PARAM_STR);
                    $user_check->execute();
                    if($user_check->rowCount() === 1) {
                        $_SESSION['user'] = $username;
                        $newid = "";
                        $clearid = $conn->prepare("UPDATE users SET uniq=? WHERE username=? AND pass=?;");
                        $clearid->bindParam(1, $newid, PDO::PARAM_STR);
                        $clearid->bindParam(2, $username, PDO::PARAM_STR);
                        $clearid->bindParam(3, $password, PDO::PARAM_STR);
                        $clearid->execute();
                        $conn = null;
                        header("Location: ../securepage.php");
                        exit();
                    }
                    else {
                        session_destroy();
                        $conn = null;
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }
        }
    }
?>