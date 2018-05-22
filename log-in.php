<?php
require'includes/functions.php';
include'header.php';
$validation = array();
if(isset($_SESSION['mailbox'])):
  header("refresh:2; url=index.php");
  exit();
 ?>

<?php
else:
  if (isset($_POST['log-in'])) {
    $validation = validation($_POST,array(
      'email'=>array(
        'verplicht'=>true,
      ),
      'wachtwoord'=>array(
        'verplicht'=>true
      )
    ));
    if(!$validation){
      $values = array('Mailbox' => $_POST['email'],'wachtwoord'=>$_POST['wachtwoord']);
      if($results = selectAndCountWhere('Gebruiker',"mailbox = :Mailbox and wachtwoord = :wachtwoord",$values)){
        $user = selectWhere('*',"Gebruiker","mailbox = :Mailbox and wachtwoord = :wachtwoord",$values);
        $_SESSION['user'] = $user[0]["Gebruikersnaam"];
        $_SESSION['voornaam'] = $user[0]["voornaam"];
        $_SESSION['achternaam'] = $user[0]["achternaam"];
        $_SESSION['mailbox'] = $user[0]["Mailbox"];
        $_SESSION['rol'] = $user[0]["Mailbox"];
        header("refresh:1; url=index.php");
        exit();
      }
    else {
      $validation[] = 'Uw email of wachtwoord is niet goed';
    }
    }
    }
?>
<div class="log-in">
  <h2>inloggen</h2>
  <form action="" method="post" style="margin:20px">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="OFF" >
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="wachtwoord" autocomplete="OFF" >
    </div>
    <button type="submit" class="btn btn-primary" name="log-in" >Inloggen</button>
  </form>
  <?php foreach ($validation as $validate ):?>
  <div class="alert alert-danger"><strong><?= $validate?></strong></div>
  <?php endforeach; ?>
</div>
<?php
endif;
?>
