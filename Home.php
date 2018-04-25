<?php

$items = selectWithJoin('*','Voorwerp v','Gebruiker G ','G.Gebruikersnaam = v.verkoper');
// var_dump($items);

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
            <a href="#" class="btn btn-success" role="button">Inloggen</a><a href="#" class="btn btn-success" role="button">Registreren</a>
        </div>
    </div>
    <div class="filter">
       <div class="binnen">
        <form class="form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Zoeken" aria-label="Username" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                </div>
                <select class="selectpicker">
                <option>Alle Groepen...</option>
              <option>auto's</option>
              <option>witgoed</option>
              <option>Electronica</option>
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
        <form class="form">
               <label>505 resultaten..</label>
                <select class="selectpicker">
                <option>Prijs omlaag</option>
              <option>prijs omhoog</option>
              <option>afstand omlaag</option>
              <option>prijs omhoog</option>
            </select>
            <a href="Admin.php" class="btn btn-success" >Admin</a>
        </form>

    </div>
    <div class="items">
      <?php  foreach ($items as $item): ?>
        <div class="item">
          <a href="?itemId=<?=$item['voorwerpnummer']?>">
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
