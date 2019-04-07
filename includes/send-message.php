<?php

    session_start();

    if ( isset($_POST['submit']) ) {

        require_once 'db.inc.php';

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $subject = mysqli_real_escape_string($conn,$_POST['subject']);
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $msg = mysqli_real_escape_string($conn,$_POST['message']);
        $user_id = null;

        var_dump($email);
        var_dump($name);
        var_dump($msg);
        var_dump($user_id);

        if ( empty($email) || empty($name) || empty($msg) ) {

            header("Location: ../contact.php?contact=empty");
            exit();

        } else {

            if ( isset($_SESSION['uid']))
            {
                $user_id = $_SESSION['uid'];
            }

            if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {

                header("Location: ../contact.php?contact=invalid_mail");
                exit();

            } else {

                $sql = "INSERT INTO messages (msg_title, email, name, message, user_id) VALUES ( '{$subject}','{$email}', '{$name}', '{$msg}', '{$user_id}')";
                $result = mysqli_query($conn, $sql);

                header("Location: ../contact.php?contact=message_sent");
                exit();

            }

        }

    } else {

        header("Location: ../contact.php");
        exit();

    }


