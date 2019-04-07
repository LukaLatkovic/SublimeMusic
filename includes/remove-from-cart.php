<?php

if ( isset($_POST['id']) && isset($_POST['user_id']) ) {

    require_once "db.inc.php";

    $idToRemove  = $_POST['id'];
    $userId = $_POST['user_id'];

    $sql = "SELECT * FROM korpa WHERE user_id = '{$userId}'";
    $result = mysqli_query($conn, $sql);

    if ( $row = mysqli_fetch_array($result) ) {

        $items = explode(',', $row['items']);

        foreach ( $items as $index => $item ) {

            if ( $item === $idToRemove ) {

                unset($items[$index]);

            }

        }
        $pushBack = implode(',', $items);

        $sqlInsert = "UPDATE korpa SET items = '{$pushBack}' WHERE user_id = '{$userId}'";
        $result = mysqli_query($conn, $sqlInsert);

        echo $idToRemove;


    } else {

        echo "Error";

    }




} else {

    echo "Error!";

}


