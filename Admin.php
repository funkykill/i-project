<?php
include'header.php';
require'includes/functie.php';
?>
<div class="Admin">
<div class="list-group">
    <a href="Admin.php" class="list-group-item list-group-item-action">Gebruikers</a>
    <a href="Admin.php?results" class="list-group-item list-group-item-action">Voorwerpen</a>
    <a href="Admin.php" class="list-group-item list-group-item-action">Rubriek</a>
  </div>
  <?php
  if(!isset($_GET['results'])){
  ?>
<div class="container">
  <h2>Gebruikers</h2>
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Gebruikersnaam</th>
        <th>voornaam en achternaam</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $results = selectWhere('*','Gebruiker');
      foreach ($results as $result):
      ?>
      <tr>
        <td><?= $result['Gebruikersnaam']?></td>
        <td><?= $result['voornaam'].' '.$result['achternaam'] ?></td>
        <td><?= $result['Mailbox']?></td>
        <td>
          <button type="button" class="btn btn-primary" data-toggle="modal"
           data-target="<?='#'.trim($result['Gebruikersnaam'])?>">
            Verwijder!
          </button>
        </td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php
foreach ($results as $result):
?>
  <div class="modal fade" id="<?=trim($result['Gebruikersnaam'])?>">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Wilt u zeker de account<?=trim($result['Gebruikersnaam'])?>
            vewijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
          <a class="btn btn-danger" href="delete.php?account=<?= $result['Gebruikersnaam']?>">Ja Zeker</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;
}else{
?>
<div class="container">
  <h2>Veilingen</h2>
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>voorwerpnummer</th>
        <th>verkoper naam</th>
        <th>Startprijs</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $results = selectWhere('*','Voorwerp');
      foreach ($results as $result):
      ?>
      <tr>
        <td><a class="idLink" href="Index.php?itemId=<?=$result['voorwerpnummer']?>"><?= $result['voorwerpnummer']?></a></td>
        <td><?= $result['verkoper']?></td>
        <td>€ <?= $result['Startprijs']?></td>
        <td>
          <button type="button" class="btn btn-primary" data-toggle="modal"
           data-target="<?='#'.trim($result['voorwerpnummer'])?>">
            Verwijder!
          </button>
        </td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>
</div>
<?php
foreach ($results as $result):
?>
  <div class="modal fade" id="<?=trim($result['voorwerpnummer'])?>">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Wilt u zeker de veiling<?=trim($result['voorwerpnummer'])?>
            vewijderen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
            <div class="modal-body">
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
          <a class="btn btn-danger" href="delete.php?account=<?= $result['Gebruikersnaam']?>">Ja Zeker</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;
?>
</div>
<?php
}
?>
<?php
include'footer.php';
?>
