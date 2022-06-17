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
        if($_POST['username'] != null || $_POST['passwd'] != null) {
            $username = htmlspecialchars(strip_tags(trim($_POST['username'])), ENT_QUOTES);
            $password = htmlspecialchars(strip_tags(trim($_POST['passwd'])), ENT_QUOTES);
            if(preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $username) || preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $password)) {
                $conn = null;
                header("Location: ../index.php?process_type=regex");
                exit();
            }
            else {
                $password = hash('SHA512', $password);
                $check_user = $conn->prepare("SELECT * FROM users WHERE username=? AND pass=?;");
                $check_user->bindParam(1, $username, PDO::PARAM_STR);
                $check_user->bindParam(2, $password, PDO::PARAM_STR);
                $check_user->execute();
                if($check_user->rowCount() === 1) {
                    $mail_content = uniqid();
                    $idcreator = $conn->prepare("UPDATE users SET uniq=? WHERE username=? AND pass=?;");
                    $idcreator->bindParam(1, $mail_content, PDO::PARAM_STR);
                    $idcreator->bindParam(2, $username, PDO::PARAM_STR);
                    $idcreator->bindParam(3, $password, PDO::PARAM_STR);
                    $idcreator->execute();
                    $user = $check_user->fetch(PDO::FETCH_ASSOC);
                    $mail_adress = $user['mail'];
                    $cname = $user['name'];
                    $mail->Charset = 'Utf-8';
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->Host = "mail.mknyazilim.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "cnsec@mknyazilim.com";
                    $mail->Password = "123456789aA+";
                    $mail->From = "contact@mknyazilim.com";
                    $mail->Fromname = "MKN Yazilim";
                    $mail->AddAddress($mail_adress, $cname." ".$csurname);
                    $mail->AddReplyTo('contact@mknyazilim.com', 'MKN Yazilim');
                    $mail->Subject = 'MKN Yazilim - Bildirim';
                    $mail->Body = "Sayın ".$cname.". ".$mail_content;
                    if(!$mail->Send()) {   
                        header("Location: ../index.php?mail=error");
                    }
                    else {
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        header("Location: ../control.php");
                    }
                }
                else {
                    $conn = null;
                    header("Location: ../index.php?process_type=nulluser");
                    exit();
                }
            }
        }
        else {
            $conn = null;
            header("Location: ../index.php");
            exit();
        }
    }
?>