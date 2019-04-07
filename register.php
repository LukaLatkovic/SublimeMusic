<html lang="en">
<head>
    <?php include_once "header.php"?>

</head>

<body>

<header>
    <a href="index.php" class="logo"><img src="img/logo.jpg" alt=""></a>
</header>

<nav class="navigacija">
    <div class="container">
        <ul>
            <li><a href="index.php">Shop</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php

                if ( isset($_SESSION['uid']) ) {

                    echo "<li><a href=\"includes/logout.inc.php\">Logout</a></li>";
                    if ( $_SESSION['status'] == 'admin' || $_SESSION['status'] == 'worker' ) {
                        echo "<li><a href=\"admin-panel.php\">Admin Panel</a></li>";
                    }

                } else {
                    echo "<li><a href=\"login.php\">Login</a></li><li><a href=\"register.php\" class='active'>Register</a></li>";
                }

            ?>
        </ul>
    </div>
</nav>


<!-- ======================================= MAIN CONTENT ======================================= -->

<main class="content">

    <div class="container">

        <div class="login-msg">
            <h1>Welcome to "Sublime music" webstore</h1>
            <h4>Create account to order and buy.</h4>
        </div>

        <div class="login-form">
            <form action="includes/register.inc.php" method="post">

                <div class="form-group">
                    <input name="flname" type="text" class="form-control nfl" placeholder="Your first and last name" autocomplete="off">
<!--                    <i class="fa fa-address-card-o" aria-hidden="true"></i>-->
                </div>

                <div class="form-group">
                    <input name="email" type="email" class="form-control nfl" placeholder="Your e-mail">
                    <!--                    <i class="fa fa-user"></i>-->
                </div>

                <div class="form-group">
                    <input name="username" type="text" class="form-control nfl" placeholder="Choose a Username" autocomplete="off">
<!--                    <i class="fa fa-user"></i>-->
                </div>

                <div class="form-group">
                    <input name="pwd" type="password" class="form-control nfl" placeholder="Choose a Password">
<!--                    <i class="fa fa-lock"></i>-->
                </div>

                <div class="form-group">
                    <input name="repwd" type="password" class="form-control nfl" placeholder="Repeat Password">
<!--                    <i class="fa fa-lock"></i>-->
                </div>

                <div class="form-group">
                    <input id="tm" type="checkbox" name="terms">
                    <label for="tm">I accept the <a href="#">Terms of Service</a></label>
                </div>

                <div class="form-group">
                    <input type="submit" value="Register" class="btn btn-success" name="submit">
                </div>

            </form>
        </div>
    </div>

</main>


<!-- ======================================= MAIN CONTENT ======================================= -->

<?php include_once "footer.php" #All scripts and page footer ?>
<!-- Page Specific scripts -->
<script>

    $(function(){
        var $form = $('form');

        $form.find('input:not([type="submit"])').on('focus', function(){
            var $this = $(this);

            if ( $this.hasClass('empty') ) {
                $this.removeClass('empty').siblings('span.err').remove();
            }

        });

        $form.on('submit', function(e){

            var $this = $(this);
            var $inputs = $this.find('input:not([type="submit"])');
            var valid = true;

            $.each($inputs, function(key, input){

                var $input = $(input);

                if ( !($input.val().length) ) {

                    $input.addClass('empty');
                    $input.parent('.form-group').append('<span class="err">This field cannot be left blank!</span>');
                    valid = false;

                }


            });

            if (!valid)
                e.preventDefault();


        });


    });

</script>
</body>
</html>





















