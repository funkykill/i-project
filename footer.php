    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#search").keyup(function(){
          var query = $("#search").val();
          if(query.length > 0){
            // console.log(query);
            $.ajax(
              {
                url:'Home.php',
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
        $(document).on('click','#suggestion_items',function(){
           var value = $(this).text();
           $("#search").val(value);
           $("#auto").html("");
        })
      });
    </script>

</body>
</html>
