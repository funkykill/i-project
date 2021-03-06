<?php
require 'connectie.php';

//retunert de data van database
function selectWithJoin($gewenstecolumen = '*',$eersteTabel,$tweedeTable,$on,$where = "1=1",$values = array()){
   $sql =  $GLOBALS['con']->prepare("select $gewenstecolumen from $eersteTabel join $tweedeTable
      on $on where {$where};");
    $sql->execute($values);
    $row=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

// retuneert aantal records met join statment

function selectAndCountJoin($eersteTabel,$tweedeTable,$on){
   $sql =  $GLOBALS['con']->query("select count(*) from $eersteTabel join $tweedeTable
      on $on;");
    $row=$sql->fetchColumn();
    return $row;
}
//retuneert aantal records met where statment
function selectAndCountWhere($table,$where = '1=1'){
   $sql =  $GLOBALS['con']->query("select count(*) from $table where $where");
    $row=$sql->fetchColumn();
    return $row;
}
//retuneert alle records met where statment
function selectWhere($column = '*',$table, $where = '1=1'){
   $sql =  $GLOBALS['con']->query("select $column from $table where $where");
    $row=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

//insert in de tabelen

function insert($tableName,$columns,$howmany,$values){
  $sql =  $GLOBALS['con']->prepare("insert into $tableName($columns) values($howmany)");
  $sql->execute($values);
  return $sql->rowCount();
}

//een record verwijderen

function delete($tableName,$condition,$where){
  $sql =  $GLOBALS['con']->prepare("delete from $tableName where $condition ");
  $sql->execute($where);
  return $sql->rowCount();
}

function textKeeper($name){
  if(isset($_GET[$name])){
    return $_GET[$name];
  }elseif(isset($_POSt[$name])){
    return $_POSt[$name];
  }
  return null;
}
?>

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
