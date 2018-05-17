<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
   <!-- Display the countdown timer in an element -->
<p id="demo0">1</p>
<p id="demo1">2</p>
<div id="current" onload="myfunction()">Sep 5, 2018 15:37:25</div>
<?php $s = '11 05, 2018 15:37:55';
echo"
<script>
var countDownDate = [];
countDownDate.push(new Date('$s').getTime());
countDownDate.push(new Date('11 05, 2018 18:40:25').getTime());
</script>";?>
<?php ?>
<script>
var teller = 0;
var x = [];
setInterval(function() {
    x[teller] = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate[teller] - now;
    console.log(teller);
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("demo"+teller).innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    if (distance < 0) {
      clearInterval(x[teller]);
      document.getElementById("demo"+teller).innerHTML = "EXPIRED";
    }
    teller ++;
    if(teller==2){
      teller = 0;
    }3
  }, 1000);
});


</script>
</body>
</html>
