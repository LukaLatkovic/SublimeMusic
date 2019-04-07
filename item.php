<html lang="en">
<head>
    <?php include_once "header.php"; include_once 'includes/db.inc.php'?>

</head>

<body>

<header>
    <a href="index.php" class="logo"><img src="img/logo.jpg" alt=""></a>
</header>

<nav class="navigacija">
    <div class="container">
        <ul>
            <li><a href="index.php">Shop</a></li>
            <li><a href="contact.php" >Contact</a></li>
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

        <div class="itemLarge">

            <?php

                $itemId = $_GET['id'];
                $sql = "SELECT * FROM items WHERE id = {$itemId}";
                $result = mysqli_query($conn, $sql);
                $curr = "€";
                $url = "notfound.png";



                if ( $row = mysqli_fetch_assoc($result) ) {

                    
                    if ( $row['imgurl'] !== NULL )
                        $url = $row['imgurl'];

                    if ( isset($_SESSION['uid']) ) {

                        $button = "<button data-itemId='{$row['id']}' type='button' id='addToCart' class='btn btn-success'><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i> Add to cart</button>";

                    } else {

                        $button = "<span class='notLogged'>You must <a href='login.php'>log in</a> to access cart</span>";

                    }

                    echo "<h1>{$row['name']}</h1><h2>{$row['brand']}</h2><hr><div class='imgAndDesc'><div class='itemImg'><img src='img/upload/".$url."'></div><div class='itemDesc'><p>{$row['descr']}</p><div class='actions'><span class='itemLarge-price'><span class='pc'>Price: </span>{$row['price']} {$curr}</span>{$button}</div></div></div><br>";

                } else {

                    echo "Doslo je do greske. Taj proizvod ne postoji";

                }


            ?>

        </div>

    </div>

</main>

<?php include_once "footer.php" #All scripts and page footer ?>
<!-- Page Specific scripts -->

<script>

    $(function(){

        var $button = $('#addToCart');

        console.log($button);

        $button.on('click', function(e){

            var data = $(this).attr('data-itemId');

            $.ajax({
                url: 'includes/add-to-cart.inc.php',
                data: { "id" : data },
                method: 'post',
                success: function(data){
                    alert(data);
                }


            });

        });

    });

</script>
</body>
</html>














