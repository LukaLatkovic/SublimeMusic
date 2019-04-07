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
            <li><a href="contact.php">Contact</a></li>
            <?php

            if ( isset($_SESSION['uid']) ) {

                echo "<li><a href=\"includes/logout.inc.php\">Logout</a></li>";
                if ( $_SESSION['status'] == 'admin' || $_SESSION['status'] == 'worker' ) {
                    echo "<li><a href=\"admin-panel.php\" class=\"active\">Admin Panel</a></li>";
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
	<div class="container">

            <?php if ( isset($_SESSION['uid']) ) { echo "<h1 class='wbmsg'>Pozdrav, ".$_SESSION['fname']." !"."</h1>"; } ?>

        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#messages">Messages</a></li>
            <li><a data-toggle="tab" href="#menu1">Orders</a></li>
        </ul>
		
         <div class="tab-content admin-panel">
            <div id="messages" class="tab-pane fade in active">
                <?php

                    if ($_SESSION['status'] === 'admin') {
                        $sql = "SELECT * FROM messages";
                        $result = mysqli_query($conn, $sql);

                        while ( $row = mysqli_fetch_assoc($result) ) {

                            $sql = "SELECT username FROM users WHERE id = {$row['user_id']}";
                            $result2 = mysqli_query($conn, $sql);

                            if ( $row2 = mysqli_fetch_assoc($result2) )
                            {
                                $senderName = $row2['username'];
                            } else {
                                $senderName = "Non registered user";
                            }


                            if ( !$row['isNotRead'] )
                            {
                                echo "<div class=\"message\" data-id=\"".$row['id']."\"><h3 class=\"subject\">".$row['msg_title']."</h3><br><p>".$row['message']."</p><br><span class=\"sb\">Sent by: ".$senderName."</span><br><span class=\"senderEmail\">Sender email: ".$row['email']."</span><br><span class='isRead'>Read ✔</span></div>";
                            } else
                            {
                                echo "<div class=\"message read\" data-id=\"".$row['id']."\"><h3 class=\"subject\">".$row['msg_title']."</h3><br><p>".$row['message']."</p><br><span class=\"sb\">Sent by: ".$senderName."</span><br><span class=\"senderEmail\">Sender email: ".$row['email']."</span><br><span data-toggle=\"tooltip\" title=\"Set to Read\" class='isNotRead'>Not read ✘</span></div>";
                            }

                        }
                    } else {

                        echo "Nemate pristup ovom odeljku";

                    }

                ?>

            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Orders</h3>

                <?php


                    $sql = "SELECT * FROM orders";
                    $result = mysqli_query($conn, $sql);

                    while ( $row = mysqli_fetch_assoc($result) ) {

                        echo "<div class='order'>Order id: ".$row['id']."<br>User id: ".$row['user_id']."<br>Name: ".$row['name']."<br>Phone number: ".$row['phone']."<br>Order value: ".$row['cost']." €<br>Order City: ".$row['city']."<br>Order address: ".$row['address']."<br>Order item id's: ".$row['items']."<br>"."</div>";

                    }


                ?>


            </div>
        </div>
    </div>


</main>

<?php include_once "footer.php"; #All scripts and page footer ?>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        var readSpan = $('.isNotRead');

        readSpan.on('click', function(){

            $this = $(this);

            $.ajax({
                url: 'includes/admin_panel_partials/message-actions.php',
                data: {read:1, msg_id:$this.parent('.message').data('id')},
                method: 'post',
                context: this,
                success: function(data) {
                    $this.attr('class', data);
                    $this.text('Read ✔');
                    $this.parent('.message').removeClass('read');
                }

            });

        });


    });
</script>
</body>
</html>