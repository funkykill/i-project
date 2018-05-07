<?php
require_once'includes/functie.php';
$breadcrumbs = array(array(
  'link' => 'Index.php',
  'title'=> 'Home',
));
 ?>

 <?php function showBreadcrumb($breadcrumbs){ ?>
  <ol class="breadcrumb">
<?php foreach ($breadcrumbs as $breadcrumb): ?>
    <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'] ?>"><?php echo $breadcrumb['title'] ?></a></li>
<?php endforeach; ?>
  </ol>
<?php } ?>
