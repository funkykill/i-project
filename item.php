<?php
require'includes/functions.php';
include_once'header.php';
require_once'breadcrumb.php';
if(textkeeper('itemId')):
$itemID = textkeeper('itemId');
$items = selectWithJoin('*','Gebruiker G','Voorwerp V','v.verkoper = g.Gebruikersnaam join
Voorwerp_in_Rubriek VR on VR.voorwerpnummer = V.voorwerpnummer
join rubriek R on R.rubrieknummer = VR.Rubriek_op_Laagste_Niveau',
'V.voorwerpnummer = ?',[$itemID]);
$fotos = selectWhere('*','Bestand', 'Voorwerp = ?', [$itemID]);
$teller = 0;
$rubriek = selectWithJoin('*','rubriek R','Voorwerp_in_Rubriek VR','R.rubrieknummer = VR.Rubriek_op_Laagste_Niveau',
'VR.voorwerpnummer = '.$itemID);
//voeg de rubreik naam en rubrieknummer toe aan de breadcrumb
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
<div style="height:50px;"></div>
<div class="item_information">
  <!-- kijk maar naar deze link om de deze code te begrijpen https://www.w3schools.com/bootstrap/bootstrap_carousel.asp  -->
  <?php
  $active = 'active';
  foreach ($items as $item): ?>
  <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <?php foreach ($fotos as $foto):?>
      <li class="<?php echo $active?>" data-target="#demo" data-slide-to="<?php echo $teller++;?>"></li>
    <?php
    $active = '';
   endforeach; ?>
  </ul>
  <div class="carousel-inner">
    <?php $active = 'active';
    foreach ($fotos as $foto): ?>
      <div class="carousel-item <?php echo $active?>">
        <img src="media/<?php echo $foto['filenaam']?>" alt="<?php echo $foto ?>"height="500">
      </div>
    <?php
    $active = '';
    endforeach;
    ?>

      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
    </div>
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
  <h3>Alle bidiengen</h3>
  <div class="bids">
    <ul class="list-group">
      <?php $bids =  selectWithJoin('*','Bod B','Voorwerp V',' B.Voorwerp = V.voorwerpnummer',
      'V.voorwerpnummer = ? ',[$item['voorwerpnummer']]);
      foreach ($bids as $bid):
      ?>
      <li class="list-group-item"><?=$bid['Gebruiker'].': &euro;'. $bid['Bodbedrag']?>
        <span style="float:right;" class="badge"><?= $bid['BodDag'].' '.$bid['BodTijdstip']?></span>
      </li>
     </ul>
  </div>
<?php
  endforeach;
  endforeach;
  ?>
</div>
<?php
else:
 ?>

 <?php
endif;
include'footer.php';
  ?>
