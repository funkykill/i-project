<?php
require'Includes/functie.php';
include'Includes/connectie.php';
include'header.php';
(isset($_GET['itemId']))?include'item.php' : include'Home.php';
include'footer.php';
?>
