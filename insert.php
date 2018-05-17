<?php
include'header.php';
require'Includes/functions.php';
if(isset($_POST["insert"])){
$values = array(150,trim($_POST["rubriekName"]),trim($_POST["rubriekParent"]));
if($howmany = insert('Rubriek','rubrieknummer,rubrieknaam,rubriek','?,?,?',$values)){
?>
<div class="alert alert-success">
    <strong>Success!</strong><?=$howmany?> rubriek is toegevoegd.
</div>
<?php
}else{
  ?>
  <div class="alert alert-danger">
      <strong>Helaas!</strong> iets is mits gegaan.
  </div>

  <?php
}}
 ?>
 <?php
 include'footer.php';
  ?>
