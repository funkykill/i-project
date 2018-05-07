<?php
require'includes/functie.php';
include_once'header.php';
require_once'breadcrumb.php';
if(textkeeper('itemId')):
$itemID = textkeeper('itemId');
$items = selectWithJoin('*','Gebruiker G','Voorwerp V','v.verkoper = g.Gebruikersnaam',
'V.voorwerpnummer ='.$itemID);
$rubriek = selectWithJoin('*','rubriek R','Voorwerp_in_Rubriek VR','R.rubrieknummer = VR.Rubriek_op_Laagste_Niveau',
'VR.voorwerpnummer = '.$itemID);
$breadcrumbs[] = array(
  'link'=>'index.php?rubriek='.$rubriek[0]['rubrieknummer'],
  'title'=>$rubriek[0]['rubrieknaam']
);
$breadcrumbs[] = array(
  'link'=>'#',
  'title'=>$items[0]['title']
);
showBreadcrumb($breadcrumbs);
?>
<div class="item_information">
  <?php  foreach ($items as $item): ?>
  <img src="media/<?=trim($item['title'])?>.JPG" alt="<?=$item['title']?>">
  <h5> <?= $item['title'] ?></h5>
  <h5>Vekoper:<a href="?userId = <?= $item['Gebruikersnaam'] ?>">
  <?= $item['voornaam'] .' ' . $item['achternaam']; ?></a></h5>
  <p>Beschrijvig: <?= $item['beschrijving'] ?></p>
  <p>Startprijs: <?= $item['Startprijs'] ?></p>
  <p>Betalingswijze: <?= $item['Betalingswijze'] ?></p>
  <p>Land: <?= $item['land'] ?></p>
  <p>Beginsdatum: <?= $item['looptijdbegindag'] ?></p>
  <p>verzendkosten: <?= $item['verzendkosten'] ?></p>
  <p>verzendinstructie:  <?= $item['verzendinstructie'] ?></p>
  <p>EindsDatum: <?= $item['looptijdeindeDag'] ?></p>
  <?php endforeach ?>
</div>
<?php
else:
 ?>

 <?php
endif;
include'footer.php';
  ?>
