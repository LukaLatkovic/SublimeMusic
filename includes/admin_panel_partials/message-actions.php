<?php

    if ( isset($_POST['read']) ) {

        require_once '../db.inc.php';

        $id = $_POST['msg_id'];
        $sql = "UPDATE messages SET isNotRead = 0 WHERE id = {$id}";
        mysqli_query($conn, $sql);

        echo "isRead";

    }

