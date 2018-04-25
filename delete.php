<?php
include'header.php';
$seconds = 2;
header("refresh:$seconds; url=Admin.php");
?>
<div class="alert alert-success">
    <strong>Success!</strong> Een account is verwijderd!, U wordt over <?=$seconds?> Seconde teruggestuurd.
</div>
