<html lang="en">
<head>
    <?php include_once "header.php"; include_once "includes/db.inc.php"?>

</head>

<body>

<header>
    <a href="index.php" class="logo"><img src="img/logo.jpg" alt=""></a>
</header>

<nav class="navigacija">
    <div class="container">
        <ul>
            <li><a href="index.php" class="active">Shop</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php

            if ( isset($_SESSION['uid']) ) {

                echo "<li><a href=\"includes/logout.inc.php\">Logout</a></li>";
                if ( $_SESSION['status'] == 'admin' || $_SESSION['status'] == 'worker' ) {
                    echo "<li><a href=\"admin-panel.php\">Admin Panel</a></li>";
                }

            } else {
                echo "<li><a href=\"login.php\">Login</a></li><li><a href=\"register.php\">Register</a></li>";
            }

            ?>
        </ul>
    </div>
</nav>


<!-- ======================================= MAIN CONTENT ======================================= -->

<main class="content">

    <div class="container">

        <form action="#" method="post" id="srch">

            <div class="form-group">
                <select name="type" id="type">
                    <option value="0">All musical instruments</option>
                    <option value="1">Classic guitar</option>
                    <option value="2">Electric guitar</option>
                    <option value="3">Bass guitar</option>
                    <option value="4">Amplifier</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="search" class="form-control" autocomplete="off" placeholder="Enter name for search">
            </div>
            <div class="form-group">
                <select name="brandFilter" id="brandFiler" class="form-control">

                    <option value="">Select brand</option>
                    <?php

                    $sql = "SELECT DISTINCT brand FROM items";
                    $result = mysqli_query($conn, $sql);

                    while ( $row = mysqli_fetch_array($result) ) {

                        echo "<option value='".$row[0]."'>".$row[0]."</option>";

                    }


                    ?>

                </select>
            </div>

            <div class="form-group">
                <input type="number" name="min" placeholder="From price">
                <input type="number" name="max" placeholder="To price">
            </div>

            <div class="form-group">
                <select name="order" id="order">
                    <option value="0">Order by</option>
                    <option value="1">Minimum price</option>
                    <option value="2">Maximum price</option>
                    <option value="3">Name ascending</option>
                    <option value="4">Name decending</option>
                </select>
            </div>

        </form>


        <hr>

        <?php

            if ( isset($_SESSION['uid']))
                echo "<div><a class=\"korpa\" href=\"basket.php?userid=".$_SESSION['uid']."\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i> My cart</a></div>"

        ?>


        <div class="shop">

            <?php

            $sql = "SELECT * FROM items";
            $result = mysqli_query($conn, $sql);

            while ( $row = mysqli_fetch_assoc($result) ) {

                if ( !($row['type'] == "Pivo") ) {
//                        echo $row['type'];
                    echo "<a href='item.php?id=".$row['id']."' class=\"item\"><h4>".$row['name']."</h4><img src=\"img/guitarmaiin.png\" alt=\"\"><span>".$row['price']."€</span></a>";
                } else {
                    echo "<a href='item.php?id=".$row['id']."' class=\"item\"><h4>".$row['name']."</h4><img src=\"img/guitarmain.png\" alt=\"\"><span>".$row['price']." din</span></a>";
                }

            }



            ?>

        </div>



    </div>

</main>

<?php include_once "footer.php" #All scripts and page footer ?>
<!-- Page Specific scripts -->
<script src="js/searchItems.js"></script>
</body>
</html>





















