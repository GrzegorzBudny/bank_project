<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, pomoc">
    <meta name="description" content="Strona pomocy">
    <title>Pomoc</title>
<style>
body {
background-image: url("background.png");
background-color:black;
color:white;
}
.button {
width: 100px;
height: 35px;
background-color:red;
float:right;
margin-right:10px;
} 
h1{
float:left;
margin-left:50px;
}
table{ 
margin:auto;
}
 td { 
 background-color:grey;
 border: 1px solid black;
 }
  th { 
 background-color:black;
 border: 1px solid black;
 }
.cos {
width: 1050px;
height: 550px;
background: RoyalBlue;
position: absolute;
top: 0;
right: 0;
bottom: 0; 
left: 0;
margin: auto; 
border:outset 10px blue;
margin-left:400px;
margin-top:140px;
}
.pom {
	font-size:30px;
	float:left;
	margin-left:30px;
}
.pp {

	float:left;
	margin-left:-50px;
	margin-top:100px;
	text-align:left;
	color:black;
}

</style>
</head>
<body>
<div class="cos" style="text-align: center">

<form action="pomoc.php" method="post">

<br><br><br><input type="submit" class="button" name="button5" value="Wyloguj" />
<input type="submit" class="button" name="button2" value="Cofnij" />

<?php

if (isset($_POST['button5'])) {
	header('Location: index.php');
}

	
if (isset($_POST['button2'])) {
	header('Location: konto.php');
}
?>

<b><p class="pom">POMOC</p></b>
<p class="pp"> CENTRUM TELEFONICZNE 24/7
<br> Płączenia krajowe
<br> 807 312 123
<br> Połączenia krajowe i z zagranicy
<br> +48 22 123 00 00
<br> ZASTRZEŻ SWOJĄ KARTĘ
<br> System Zastrzegania kart
<br> +48 828 828 828
<br>
<br> Napisz do nas
<br> Email:kontakt@KGMD.pl
<br> ADRES KORESPONDENCYJNY
<br> KGMD bank Polska ul.Szafrana 5
<br> Zielona Góra

</div>
</form>
</body>
</html>

