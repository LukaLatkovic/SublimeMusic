<?php

$conn = @mysqli_connect('localhost','root', '', 'projekat') or die("Nije uspela konekcija na bazu podataka!");
mysqli_query($conn, "SET NAMES UTF8");


