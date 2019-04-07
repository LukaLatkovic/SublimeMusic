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
            <li><a href="contact.php" class="active">Contact</a></li>
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
        <h3 class="contact">Contact</h3>
        <hr>
        <aside class="details col-sm-12 col-md-6">
			<br>
			<br>
            <ul class="contactDetails">
                <li>Adress:</li>
                <li>Kralja Milana 54, Belgrade</li>
                <br>
                <li>Email: <a href="mailto:contact@sublimemusic.com">kontakt@sublimemusic.com</a></li>
                
                <li>Phone: (+381) 61/311-3214</li>
                <li>Fax: (+381) 11/484-8484</li>
            </ul>
        </aside>
		<?php
            if ( isset($_SESSION['uid']) ) {
                echo "
				<h3 class='contact'>Reklamacije</h3>
				<aside class='contact-form col-sm-12 col-md-6'>
            <form action='includes/send-message.php' method='post'>
                <div class='form-group'>
                    <label for='subject'>Message subject</label>
                    <input type='text' name='subject' id='subject' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='email'>Enter your email</label>
                    <input type='email' name='email' id='email' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='name'>First and Last name</label>
                    <input type='text' name='name' id='name' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='msg'>Message</label>
                    <textarea name='message' id='msg' cols='30' rows='10' class='form-control'></textarea>
                </div>
                <div class='form-group'>
                    <input type='submit' class='btn btn-success' value='Send message' name='submit'>
			</div>
            </form>
			";}  
			?>
        </aside>

        

    </div>

</main>

<?php include_once "footer.php" #All scripts and page footer ?>
<!-- Page Specific scripts -->
</body>
</html>





















