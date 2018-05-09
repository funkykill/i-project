<?php
if(isset($_GET["search"])||isset($_GET["ordering"])){
  $search = '%'.textkeeper('search_text').'%';
  $rubriek = textkeeper("rubriek");
  $end = strpos($rubriek,'/');
  $rubrikename = substr($rubriek, $end+1 ,strlen($rubriek));
  $rubriek = substr($rubriek,0,$end);
  $ordering = textkeeper('ordering')?textkeeper('ordering'):'Startprijs';
  if($rubriek == -1){
    $rubrikename = 'alle rubrieken';
    $items = selectWithJoin('*','Voorwerp v','Gebruiker G ','G.Gebruikersnaam = v.verkoper','1=1 order by '.$ordering);
  }
  else{
  echo $ordering;
  $values = array('search' => $search,'rubriek'=>$rubriek);
  $items = selectWithJoin('*','Voorwerp v','Voorwerp_in_Rubriek vr ','v.voorwerpnummer =
  vr.voorwerpnummer join Gebruiker G on G.Gebruikersnaam = v.verkoper',
  "V.title like :search and vr.Rubriek_op_Laagste_Niveau = :rubriek order by ".$ordering,$values);
  }
}else{
  $items = selectWithJoin('*','Voorwerp v','Gebruiker G ','G.Gebruikersnaam = v.verkoper');
}
?>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
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
                  <input type="text" class="form-control" name="search_text"
                placeholder="Zoeken" value="<?= textKeeper('search_text'); ?>" aria-label="Username" aria-describedby="basic-addon1">
                  <select class="form-control" id="sel1" name="rubriek">
                    <option value="<?= textKeeper('rubriek')?textKeeper('rubriek'):'-1/root';?>">
                      <?=textKeeper('rubriek')?$rubrikename:'kiest u een rubriek';?></option>
                    <option value="-1/root">Alle rubrieken</option>
                      <?php
                        $Rubriekname = selectWhere('*,rubriek as parent','Rubriek','rubriek = -1 order by rubrieknummer ASC');
                        foreach ($Rubriekname as $result){
                      ?>
                    <option value="<?= $result['rubrieknummer'].'/'.$result['rubrieknaam'];?>">
                      <?='('.$result['parent'].') '.$result['rubrieknaam'].' ('.$result['volgnr'].')'?>
                    </option>
                      <?php
                      $parent = $result['rubrieknummer'];
                      $subRubriekResults = selectWhere('* ,rubriek as parent','Rubriek','rubriek ='.$parent);
                      foreach ($subRubriekResults as $subresult){
                      ?>
                      <option value="<?=$subresult['rubrieknummer'].'/'.$subresult['rubrieknaam'];?>">&nbsp;&nbsp;&nbsp;
                        <?='('.$subresult['parent'] .') '.$subresult['rubrieknaam'].' ('.$subresult['volgnr'].')'?></option>
                        <?php
                        $parent1 = $subresult['rubrieknummer'];
                        $subSubRubriekResults = selectWhere('* ,rubriek as parent','Rubriek','rubriek ='.$parent1);
                        foreach ($subSubRubriekResults as $suSubbresult){
                        ?>
                        <option  value="<?=$suSubbresult['rubrieknummer'].'/'.$suSubbresult['rubrieknaam'];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?='( '.$suSubbresult['parent'] .') '.$suSubbresult['rubrieknaam'].' ('.$suSubbresult['volgnr'].')'?></option>
                        <?php
                            }}}
                        ?>
          </select>
                <input type="text" class="form-control" id="postal" placeholder="Uw postcode" aria-label="Username" aria-describedby="basic-addon1">
                <select class="selectpicker" >
                <option>Alle Afstanden</option>
                  <option>> 3KM</option>
                  <option>> 10KM</option>
                  <option>> 15KM</option>
                </select>
              <button type="submit" class="btn btn-success" name="search">Zoeken</button>
            </div>
        </div>
    </div>
    <div class="resultaat">
               <label>505 resultaten..</label>
                <select class="selectpicker" name="ordering" onchange="this.form.submit()">
                  <option value="" >....</option>
                  <option value="startprijs desc" >Prijs omlaag</option>
                  <option value="startprijs ASC">prijs omhoog</option>
                  <option value="3">afstand omlaag</option>
                  <option value="4">prijs omhoog</option>
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
