<?php
require'includes/functions.php';
include_once'header.php';
if(isset($_POST['search'])){
$response = '<ul><li>no data found</ul></li>';
$search = '%'.$_POST['q'].'%';
 $autoCompleet = selectWhere('DISTINCT title','Voorwerp',"title like '%$search%'");
 $response = '<ul class="new"  style = "list-style:none; width: 100px; margin:0; border:1px solid gray; float: left;">';
 foreach ($autoCompleet as $result) {
   $response .= "<a href='#'><li id='sugestion'>".$result['title']."</li></a>";
 }
 $response .= '</ul>';
  exit($response);
}
 ?>

<form class="" action="" method="Get">
  <input id="search" type="text" name="search" value="" autocomplete="off">
  <div class="" id="auto" style="margin:0;padding:0;">
  </div>
</form>


 <script src="https://code.jquery.com/jquery-3.3.1.min.js"
   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
   crossorigin="anonymous"></script>
   <script type="text/javascript">
     $(document).ready(function(){
       $("#search").keyup(function(){
         var query = $("#search").val();
         if(query.length > 0){
           // console.log(query);
           $.ajax(
             {
               url:'ajax.php',
               method:'POST',
               data: {search:1, q:query },
               success : function(data){
                 $("#auto").html(data);
               },
               dataType:'text'
             }
           );
         }
       });
       $(document).on('click','#sugestion',function(){
          var value = $(this).text();
          $("#search").val(value);
          $("#auto").html("");
       })
     });
   </script>
