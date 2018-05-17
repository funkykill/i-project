<?php
require 'connectie.php';

//retunert de data van database
function selectWithJoin($gewenstecolumen = '*',$eersteTabel,$tweedeTable,$on,$where = "1=1",$values = array()){
   $sql =  $GLOBALS['con']->prepare("select $gewenstecolumen from $eersteTabel join $tweedeTable
      on $on where $where");
    $sql->execute($values);
    $row=$sql->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}

// retuneert aantal records met join statment

function selectAndCountJoin($eersteTabel,$tweedeTable,$on,$where= "1=1",$values = array()){
   $sql =  $GLOBALS['con']->prepare("select count(*) from $eersteTabel join $tweedeTable
      on $on where $where;");
    $sql->execute($values);
    $row=$sql->fetchColumn();
    return $row;
}
//retuneert aantal records met where statment
function selectAndCountWhere($table,$where = '1=1',$values = array()){
   $sql = $GLOBALS['con']->prepare("select count(*) from $table where $where");
   $sql->execute($values);
   $row=$sql->fetchColumn();
   return $row;
}
//retuneert alle records met where statment
function selectWhere($column = '*',$table, $where = '1=1', $values = array()){
   $sql =  $GLOBALS['con']->prepare("select $column from $table where $where");
   $sql->execute($values);
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

function validation($source, $items = array()){
    $erros = array();
    foreach ($items as $item => $rules) {
      foreach ($rules as $rule => $rule_value) {
        $value = trim($source[$item]);
        // echo $value;
        if($rule ===  'verplicht' && empty($value)){
          $erros[] = $item. ' is ' .$rule;
        }
        elseif (!empty($value)) {
           switch ($rule) {
             case 'min':
               if (strlen($value)<$rule_value) {
                 $erros[] = $item. ' moet meer dan ' .$rule_value;
               }
               break;
               case 'max':
               if (strlen($value)>$rule_value) {
                 $erros[] = $item. ' moet minder dan ' .$rule_value;
               }
                 break;
           }
        }
      }
    }
    return $erros;
}



?>
