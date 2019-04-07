<html lang="en">
<head>
    <?php include_once "header.php"; include_once 'includes/db.inc.php';

        if ( !isset($_SESSION['uid']) )
            header("Location: shop.php");

    ?>

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

        <div class="cart">

            <?php


            $totalCost = 0;
            

            $sql = "SELECT * FROM korpa WHERE user_id = {$_SESSION['uid']}";
            $result = mysqli_query($conn, $sql);

            if ( $row = mysqli_fetch_assoc($result) ) {

                $arrayOfItems = explode(',', $row['items']);

            }


            if ( $arrayOfItems[0] == "" ) {

                echo "<h3>No products in your cart!</h3>";

            } else {

                foreach ( $arrayOfItems as $itemId )
                {

                    $sqlFetch = "SELECT * FROM items WHERE id = {$itemId}";
                    $fetchResult = mysqli_query($conn, $sqlFetch);

                    if ( $itemRow = mysqli_fetch_assoc($fetchResult) ) {

                        $imgName = "default.png";

                        if ( $itemRow['imgurl'] != NULL ) {

                            $imgName = $itemRow['imgurl'];

                        }

                        $totalCost += $itemRow['price'];

                        echo '<div class="cart-item" data-id="'.$itemRow['id'].'"><div class="cart-info"><img src="img/upload/'.$imgName.'" alt=""><div class="cart-details"><h2 class="cart-item-title">'.$itemRow['name'].'</h2><h4>'.$itemRow['brand'].'</h4><p class="item-size">'.$itemRow['size'].' piece</p></div></div><div class="cart-price"><span class="cart-item-price">'.$itemRow['price'].' €</span><br> <button class="btn btn-danger remove-from-cart" data-id="'.$itemRow['id'].'">Remove from cart</button></div></div>';

                    }


                }

            }

            echo "<hr>";
            echo "<h3 id='tc' style=\"color: #ddd; position: relative\">Total: <span style=\"position: absolute; right: 0; color: #ddd; font-size: 23px\">{$totalCost} €</span></h3>";
            echo "<button style='float: right;' id='checkout' class='btn btn-success'>Checkout</button>";


            ?>

        </div>

    </div>

</main>

<div id="checkoutModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Checkout</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="checkoutForm">

                    <div class="form-group">
                        <label for="flname">First and last name:</label>
                        <input class="form-control" id="flname" type="text" name="flname" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input class="form-control" id="city" type="text" name="city">
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="form-control" id="address" type="text" name="address">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone number:</label>
                        <input class="form-control" id="phone" type="tel" name="phone">
                    </div>


                    <div class="form-group">
                        <span id="totalCost"></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" value="Order" class="btn btn-success">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php include_once "footer.php" #All scripts and page footer ?>
<!-- Page Specific scripts -->
<script>

    var removeBtn = $('.remove-from-cart'),
        item = $('.cart-item');

    removeBtn.on('click', function(){

        var id = $(this).data('id');

        $.ajax({
            url: "includes/remove-from-cart.php",
            method: 'post',
            context: this,
            data: { "user_id" : <?=$_SESSION['uid']?>, "id" : id },
            success: function(data){

                removeFromCart(data);

            }

        });

    });

    function removeFromCart(someId) {

        $.each(item, function(){

            var price = parseInt($(this).find('.cart-item-price').text());

            if( $(this).data('id') == someId ){

                $(this).remove();
                var totalCost = parseInt($('#tc').find('span').text());

                var newTotalCost = totalCost - price;
                $('#tc').find('span').text(newTotalCost + " €");

            }

        });

        if ( !($('.cart-item').length) )
            $('.cart').prepend("<h3>Nema proizvoda u vasoj korpi!</h3>");

    }

    var checkOut = $('#checkout'),
        modal = $('#checkoutModal'),
        newCost;

    checkOut.on('click', function(){

        newCost = $('#tc').find('span').text();

        if ( $('.cart-item').length ){
            modal.find('#totalCost').text(newCost);
            modal.modal('show');
        } else {

            alert("You must add something to the cart first!");
            window.location.href = "shop.php";

        }


    });


    var coForm = $('#checkoutForm');
    var allItemsFinal = $('.cart-item');
    var ids = [];

    $.each(allItemsFinal, function(){
        ids.push($(this).data('id'));
    });


    coForm.on('submit', function(e){

        var inputs = $(this).find('input'),
            imaPraznih = false;

        $.each(inputs, function(){

            if ( this.value === '') {
                imaPraznih = true;
                return false;
            }

        });

        if ( imaPraznih ) {

            alert("You must fill out all of the fields!");

        } else {

            var values = $(this).serialize();
            newCost = newCost.replace(" €","");

            values += "&totalPrice="+newCost+"";
            values += "&user_id=<?=$_SESSION['uid']?>";
            values += "&items="+ids.toString()+"";

            console.log(values);
            console.log(typeof(values));

            $.ajax({
                url: "includes/order.inc.php",
                method: "post",
                data: values,
                success: function(data){

                    alert(data);
                    window.location.href = "index.php";

                }


            });

        }

        e.preventDefault();
    });


</script>
</body>
</html>














