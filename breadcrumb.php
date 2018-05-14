<?php
require_once'includes/functions.php';
$breadcrumbs = array(array(
  'link' => 'Index.php',
  'title'=> 'Home',
));
 ?>

 <?php function showBreadcrumb($breadcrumbs){ ?>
  <ol class="breadcrumb" style="width: 100%; height: 50px; position: fixed; ">
<?php foreach ($breadcrumbs as $breadcrumb): ?>
    <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'] ?>"><?php echo $breadcrumb['title'] ?></a></li>
<?php endforeach; ?>
  </ol>
<?php } ?>
