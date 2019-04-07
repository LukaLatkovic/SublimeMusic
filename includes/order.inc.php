<?php

    require_once "db.inc.php";

    $name = mysqli_real_escape_string($conn, $_POST['flname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $cost = mysqli_real_escape_string($conn, $_POST['totalPrice']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $items = $_POST['items'];
    $userId = $_POST['user_id'];




    $sql = "INSERT INTO orders ( user_id, address, `name`, phone, cost, city, items) VALUES ( '{$userId}', '{$address}', '{$name}', '{$phone}', '{$cost}', '{$city}', '{$items}' )";
    mysqli_query($conn, $sql);

    $sqlRemoveFromCart = "UPDATE korpa SET items = '' WHERE user_id = '{$userId}'";
    mysqli_query($conn, $sqlRemoveFromCart);

    echo "Order complete!\nClick OK to keep shopping...";





