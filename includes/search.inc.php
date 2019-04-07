<?php

    if ( isset($_POST['search']) || isset($_POST['brandFilter']) || isset($_POST['min']) || isset($_POST['max']) ) {

        require_once 'db.inc.php';

        $search = $_POST['search'];
        $brandFilter = $_POST['brandFilter'];
        $minCena = $_POST['min'];
        $maxCena = $_POST['max'];
        $order = $_POST['order'];
        $type = $_POST['type'];

        if ( $brandFilter == "" ) {

            $sql = "SELECT * FROM items WHERE (brand LIKE '%$search%' OR name LIKE '%$search%') ".concMinMax($minCena, $maxCena).processType($type).orderBy($order);
            $result = mysqli_query($conn, $sql);

        } else {

            $sql = "SELECT * FROM items WHERE (brand LIKE '%$search%' OR name LIKE '%$search%') AND brand IN ( '$brandFilter' ) ".concMinMax($minCena, $maxCena).processType($type).orderBy($order);
            $result = mysqli_query($conn, $sql);

        }

        while ( $row = mysqli_fetch_assoc($result) ) {

            
                echo "<a href='item.php?id=".$row['id']."' class=\"item\"><h4>".$row['name']."</h4><img src=\"img/guitarmaiin.png\" alt=\"\"><span>".$row['price']."€</span></a>";
            }

        }



     else {

        echo "Nooooooooo set";

    }


    function concMinMax ($min, $max) {

        if ( empty($min) ) {

            if ( empty($max) ) {

                return " ";

            } else {

                return "AND price < '$max' ";

            }

        } else {

            if ( empty($max) ) {

                return "AND price > '$min' ";

            } else {

                return "AND price BETWEEN '$min' AND '$max' ";

            }

        }

    }

    function orderBy($ord) {

        switch ($ord) {

            case 1:
                return "ORDER BY price ASC";
                break;
            case 2:
                return "ORDER BY price DESC";
                break;
            case 3:
                return "ORDER BY name ASC";
                break;
            case 4:
                return "ORDER BY name DESC";
                break;

            default:
                return "";
                break;

        }

    }


    function processType($type){

        switch ($type) {

            case 0:

                return "";
                break;

            case 1:

                return "AND type = 'Klasicna' ";

                break;
            case 2:

                return "AND type = 'Elektricna' ";

                break;

            case 3:

                return "AND type = 'Bas' ";

                break;

            case 4:

                return "AND type = 'Pojacalo' ";

                break;

            default:

                return "";

                break;

        }

    }

















