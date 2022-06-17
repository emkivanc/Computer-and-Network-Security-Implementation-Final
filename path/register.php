<?php
    session_start();
    include("../connection/connection.php");
    if($_SESSION['user'] != null) {
        $conn = null;
        header("Location: ../securepage.php");
        exit();
    }
    else {
        if($_POST['username'] == null || $_POST['passwd'] == null || $_POST['name'] == null || $_POST['mail'] == null) {
            $conn = null;
            header("Location: ../register.php");
            exit();
        }
        else {
            $username = htmlspecialchars(strip_tags(trim($_POST['username'])), ENT_QUOTES);
            $passwd = htmlspecialchars(strip_tags(trim($_POST['passwd'])), ENT_QUOTES);
            $name = htmlspecialchars(strip_tags(trim($_POST['name'])), ENT_QUOTES);
            $mail = htmlspecialchars(strip_tags(trim($_POST['mail'])), ENT_QUOTES);
            if(preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $username) || preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $passwd) || preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $name) || preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $mail)) {
                $conn = null;
                header("Location: ../register.php");
                exit();
            }
            else {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $passwd = hash('SHA512', $passwd);
                    $insert_reg = $conn->prepare("INSERT INTO users (name,username,pass,mail,uniq,qrlogin) VALUES (?,?,?,?,'','');");
                    $insert_reg->bindParam(1, $name, PDO::PARAM_STR);
                    $insert_reg->bindParam(2, $username, PDO::PARAM_STR);
                    $insert_reg->bindParam(3, $passwd, PDO::PARAM_STR);
                    $insert_reg->bindParam(4, $mail, PDO::PARAM_STR);
                    $insert_reg->execute();
                    $conn = null;
                    header("Location: ../register.php?process=ok");
                    exit();
                }
                else {
                    $conn = null;
                    header("Location: ../register.php");
                    exit();
                }
            }
        }
    }
?>