<?php
if(isset($_GET["search"])){
  $search = '%'.textkeeper('search_text').'%';
  $rubriek = textkeeper("rubriek");
  $values = array('search' => $search,'rubriek'=>$rubriek);
  echo $search;
  $items = selectWithJoin('*','Voorwerp v','Voorwerp_in_Rubriek vr ','v.voorwerpnummer =
  vr.voorwerpnummer join Gebruiker G on G.Gebruikersnaam = v.verkoper',
  "V.title like :search and vr.Rubriek_op_Laagste_Niveau = :rubriek",$values);
}else{
  $items = selectWithJoin('*','Voorwerp v','Gebruiker G ','G.Gebruikersnaam = v.verkoper');
}
?>
    <div class="onder-header">
        <div class="flex">
          <?php $itemCount = selectAndCountJoin('Voorwerp v','Gebruiker G ','G.Gebruikersnaam = v.verkoper');
                $usersCount = selectAndCountWhere('Gebruiker');
          ?>
            <div class="flex-sons"><strong><?=$usersCount?></strong>Gebruikers</div>
            <div class="flex-sons"><strong><?= $itemCount ?></strong>Veilingen per dag</div>
            <div class="flex-sons"><strong>24/7</strong>Bereikbaar</div>
        </div>
        <div class="peroneal">
            <h4>Wordt nu een lid om optimaal gebruik te maken van de website</h4>
            <a href="log-in.php" class="btn btn-success" role="button">Inloggen</a>
            <a href="#" class="btn btn-success" role="button">Registreren</a>
        </div>
    </div>
    <div class="filter">
       <div class="binnen">
        <form class="form" action="index.php">
            <div class="input-group">
                <input type="text" class="form-control" name="search_text" placeholder="Zoeken" aria-label="Username" aria-describedby="basic-addon1">
                <button type="submit" class="btn btn-success" name="search">Zoeken</button>
                <select class="form-control" id="sel1" name="rubriek">
                  <option value="-1">Alle rubrieken</option>
                    <?php
                    $Rubriekname = selectWhere('*,rubriek as parent','Rubriek','rubriek = -1 order by rubrieknummer ASC');
                    foreach ($Rubriekname as $result){
                    ?>
                    <option value="<?=$result['rubrieknummer']?>">
                      <?='('.$result['parent'].') '.$result['rubrieknaam'].' ('.$result['volgnr'].')'?>
                    </option>
                      <?php
                      $parent = $result['rubrieknummer'];
                      $subRubriekResults = selectWhere('* ,rubriek as parent','Rubriek','rubriek ='.$parent);
                      foreach ($subRubriekResults as $subresult){
                      ?>
                      <option value="<?=$subresult['rubrieknummer']?>">&nbsp;&nbsp;&nbsp;
                        <?='('.$subresult['parent'] .') '.$subresult['rubrieknaam'].' ('.$subresult['volgnr'].')'?></option>
                        <?php
                        $parent1 = $subresult['rubrieknummer'];
                        $subSubRubriekResults = selectWhere('* ,rubriek as parent','Rubriek','rubriek ='.$parent1);
                        foreach ($subSubRubriekResults as $suSubbresult){
                        ?>
                        <option  value="<?=$suSubbresult['rubrieknummer']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?='( '.$suSubbresult['parent'] .') '.$suSubbresult['rubrieknaam'].' ('.$suSubbresult['volgnr'].')'?></option>
                        <?php
                            }}}
                        ?>
          </select>
                <input type="text" class="form-control" id="postal" placeholder="Uw postcode" aria-label="Username" aria-describedby="basic-addon1">
                <select class="selectpicker">
                <option>Alle Afstanden</option>
              <option>> 3KM</option>
              <option>> 10KM</option>
              <option>> 15KM</option>
            </select>
            </div>
        </form>
        </div>
    </div>
    <div class="resultaat">
        <form class="form" action="item.php">
               <label>505 resultaten..</label>
                <select class="selectpicker">
              <button type="submit" class="btn btn-success"><option>Prijs omlaag</option></button>
              <option>prijs omhoog</option>
              <option>afstand omlaag</option>
              <option>prijs omhoog</option>
            </select>
            <a href="Admin.php" class="btn btn-success" >Admin</a>
        </form>
    </div>
    <div class="container">
      <?php include'breadcrumb.php'; ?>
    </div>
    <div class="items">
      <?php  foreach ($items as $item): ?>
        <div class="item">
          <a href="item.php?itemId=<?=$item['voorwerpnummer']?>">
            <img src="media/<?=trim($item['title'])?>.JPG">
            <div class="details">
            <h6><?= $item['title'] ?></h6>
            <div class="text">
            <p><?= $item['Startprijs'] ?></p>
            <P><?= $item['looptijdeindeDag'] ?></P>
            </div>
            <p>Verkopr: <?= $item['voornaam'] .' '. $item['achternaam']?></p>
            </div>
            </a>

        </div>
      <?php endforeach ?>
    </div>
