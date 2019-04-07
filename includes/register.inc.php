<?php

if ( isset($_POST['submit']) ) {

    include_once "db.inc.php";

    $flname = mysqli_real_escape_string($conn, $_POST['flname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $usrName = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $repwd = mysqli_real_escape_string($conn, $_POST['repwd']);
    $tm = $_POST['terms'];

    if ( $flname == "" || $email == "" || $usrName == "" || $pwd == "" || $repwd == "" ) {

        header("Location: ../register.php?error=empty");
        exit();

    } else {

        $nameArr = explode(' ', $flname);
        $firstName = $nameArr[0];
        $lastName = "";

        for ( $i = 1; $i < count($nameArr); $i++ )
            $lastName = $lastName . " " . $nameArr[$i];
        $lastName = ltrim($lastName);


        if ( !preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $firstName) ) {

            header("Location: ../register.php?error=invalid");
            exit();

        } else {


            if ( $tm == 'on' ) {

                if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {

                    header("Location: ../register.php?error=email");
                    exit();

                } else {

                    if ( !($pwd == $repwd) ) {

                        header("Location: ../register.php?error=pwmatch");
                        exit();

                    } else {

                        $sql = "SELECT * FROM users WHERE username = '$usrName' OR 'email' = '$email'";
                        $result = mysqli_query($conn, $sql);

                        if ( mysqli_num_rows($result) > 0 ) {

                            header("Location: ../register.php?error=exists");
                            exit();

                        } else {

                            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                            #
                            # $hashed = md5($pwd)

                            $sql = "INSERT INTO users ( firstName, lastName, username, password, email, status ) VALUES ( '$firstName', '$lastName', '$usrName', '$hashedPwd', '$email', 'user' )";
                            mysqli_query($conn, $sql);

                            $sqlGetId = "SELECT id FROM users WHERE username = '{$usrName}'";
                            $result = mysqli_query($conn, $sqlGetId);

                            $userId = null;

                            if ( $row = mysqli_fetch_array($result) ) {

                                $userId = $row[0];

                            }

                            $sql = "INSERT INTO korpa (`user_id`) VALUES ( '{$userId}' )";
                            mysqli_query($conn, $sql);

                            header("Location: ../login.php?error=success");
                            exit();

                        }

                    }

                }

            } else {

                header("Location: ../register.php?error=terms");
                exit();

            }


        }



    }

} else {
    header("Location: ../register.php");
    exit();
}








