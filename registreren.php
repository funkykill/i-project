<?php
require_once'includes/functions.php';
include'header.php';
$validation = array();
if(isset($_POST['registreren'])){
  $validation = validation($_POST,array(
    'voornaam'=>array(
      'verplicht'=>true,
      'letters'=>true,
      'max'=>25
    ),
    'achternaam'=>array(
      'verplicht'=>true,
      'letters'=>true,
      'max'=>25
    ),
    'landnaam'=>array(
      'verplicht'=>true,
      'letters'=>true,
      'max'=>20
    ),
    'plaatsnaam'=>array(
      'verplicht'=>true,
      'letters'=>true,
    ),
    'adresregel1'=>array(
      'verplicht'=>true,
      'max'=>25
    ),
    'adresregel2'=>array(
      'max'=>25
    ),
    'postcode'=>array(
      'max'=>6
    ),
    'GeboorteDag'=>array(
      'verplicht'=>true,
      'max'=>10
    ),
    'Telefoon'=>array(
      'verplicht'=>true,
      'max'=>11,
      'nummers'=>true
    ),
    'Gebruikersnaam'=>array(
      'verplicht'=>true,
      'max'=>10,
    ),
    'Mailbox'=>array(
      'verplicht'=>true,
      'max'=>50,
      'email'=>true
    ),
    'wachtwoord'=>array(
      'verplicht'=>true,
      'max'=>50,
    ),
    'antwoordtekst'=>array(
      'verplicht'=>true,
      'max'=>30
    )
  ));
  if ($unique = selectAndCountWhere('Gebruiker','Gebruikersnaam=? or Mailbox = ?',
    array($_POST['Gebruikersnaam'],$_POST['Mailbox']))){
    $validation[] = 'Gebruikersnaam of email al in gebruik';
  }
  if(!$validation){
    $wachtwoordhash = md5($_POST['wachtwoord']);
    $values = array($_POST['Gebruikersnaam'],$_POST['voornaam'],$_POST['achternaam'],$_POST['adresregel1'],
    $_POST['adresregel2'],$_POST['postcode'],$_POST['plaatsnaam'],$_POST['landnaam'],$_POST['antwoordtekst'],
    $_POST['GeboorteDag'],$_POST['Mailbox'],$wachtwoordhash,$_POST['vraag']);
    insert('Gebruiker','Gebruikersnaam,voornaam,achternaam,adresregel1,adresregel2,
    postcode,plaatsnaam,landnaam,antwoordtekst,GeboorteDag,Mailbox,wachtwoord,vraag',
    '?,?,?,?,?,?,?,?,?,?,?,?,?',$values);
  }
}
 ?>
<div class="registeren">
<form class='form-horizontal'action="" method="post" >
    <h1>registeren</h1>
    <p>voer aub het formulier in om te registeren</p>
    <?php foreach ($validation as $validate ):?>
    <div class="alert alert-danger">
         <?php echo $validate ?>
    </div>
    <?php endforeach; ?>
    <div class="form-group">
        <label class="control-label col-sm-2" for="Gebruikersnaam">Gebruikersnaam</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="Gebruikersnaam" value="" name="Gebruikersnaam" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="voornaam">Voornaam</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="voornaam" value="" name="voornaam" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="achternaam">Achternaam</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="achternaam" value="" name="achternaam" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="Mailbox">Email</label>
        <div class="col-sm-20">
          <input type="email" class="form-control" id="Mailbox" value="" name="Mailbox" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="wachtwoord">Wachtwoord</label>
        <div class="col-sm-20">
          <input type="password" class="form-control" id="wachtwoord" value="" name="wachtwoord" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="landnaam">Land</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="landnaam" value="Nederland" name="landnaam" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="plaatsnaam">Plaatsnaam</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="plaatsnaam" value="" name="plaatsnaam" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="adresregel1">Adresregel1</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="adresregel1" value="" name="adresregel1" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="adresregel2">Adresregel2</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="adresregel2" value="" name="adresregel2">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="postcode">Postcode</label>
        <div class="col-sm-20">
          <input type="text" class="form-control" id="postcode" value="" name="postcode" required>
        </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="GeboorteDag">GeboorteDag</label>
      <div class="col-sm-20">
        <input type="date" name="GeboorteDag" class="form-control" value="<?= $information[0]['GeboorteDag']?>" name="GeboorteDag" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Telefoon">Telefoon</label>
      <div class="col-sm-20">
        <input type="text" class="form-control" id="Telefoon" name="Telefoon" required>
      </div>
    </div>
    <div class="form-inline">
       <p>Uw geheime vraag: &nbsp;&nbsp; </p>
        <div class="col-sm-offset-2 col-sm-20">
          <select name="vraag" id="vraag" class="form-control">
            <?php
            $vragen = selectWhere( '*','vraag');
            foreach($vragen as $vraag){
              ?>
              <option value="<?php echo $vraag['vraagnummer']?>"><?php echo $vraag['tekst_vraag']?></option>
            <?php };?>
          </select> &nbsp;&nbsp;
          </div>
          <input type="text" class="form-control" id="antwoordtekst" placeholder="Antwoord" value="" name="antwoordtekst" required>
    </div>
    <div class="form-group">
       <div class="col-sm-offset-2 col-sm-20">
         <button type="submit" class="btn btn-success" name="registreren">Registreren</button>
       </div>
     </div>
</form>
</div>
