<?php

    session_start();

    if ( isset($_POST['id']) && isset($_SESSION['uid']) ) {

        require_once "db.inc.php";

        $itemId = $_POST['id'];

        $sqlFetch = "SELECT items FROM korpa WHERE user_id = {$_SESSION['uid']}";
        $result = mysqli_query($conn, $sqlFetch);

        if ( $row = mysqli_fetch_array($result) ) {

            if ( $row[0] === '' ) {

                $newIds = $row[0] . $itemId;

            } else {

                $newIds = $row[0] . "," . $itemId;

            }

        }

        $sqlInsert = "UPDATE korpa SET items = '{$newIds}' WHERE user_id = '{$_SESSION['uid']}'";
        mysqli_query($conn, $sqlInsert);

        echo "Item added to cart!";


    } else {

        echo "Error";

    }




