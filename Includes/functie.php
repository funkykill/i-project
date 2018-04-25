<?php
require 'connectie.php';

//retunert de data van database
function selectWithJoin($gewenstecolumen = '*',$eersteTabel,$tweedeTable,$on,$where = '1=1'){
   $sql =  $GLOBALS['con']->query("select $gewenstecolumen from $eersteTabel join $tweedeTable
      on $on where {$where};");
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




?>
