<?php

if ( isset($_POST['submit']) ) { 

    require_once "db.inc.php";
    session_start();

    $usrName = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);


    if ( empty($usrName) || empty($pwd) ) {

        header("Location: ../login.php?login=empty");
        exit();

    } else {

        $sql = "SELECT * FROM users WHERE (username = '$usrName' OR email = '$usrName')";
        $result = mysqli_query($conn, $sql);

        if ( mysqli_num_rows($result) < 1 ) {

            header("Location: ../login.php?login=userError");
            exit();

        } elseif ( mysqli_num_rows($result) == 1 ) {

            $row = mysqli_fetch_assoc($result);
            $deHash = password_verify($pwd, $row['password']);

            if ( !$deHash ) {

                header("Location: ../login.php?login=passwordError");
                exit();

            } else {

                $_SESSION['uid'] = $row['id'];
                $_SESSION['fname'] = $row['firstName'];
                $_SESSION['lname'] = $row['lastName'];
                $_SESSION['usrname'] = $row['username'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['rdate'] = $row['regDate'];

                header("Location: ../index.php?login=success");
                exit();

            }


        }

    }


} else {

    header("Location: ../login.php");
    exit();

}










