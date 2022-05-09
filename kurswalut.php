<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, kurs walut">
    <meta name="description" content="Strona ukazujaca kurs walut">
    <title>Kurs walut</title>
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
border-spacing: 50px 3px;
}
 td { 
   color:black;

 }
  th { 
  color:black;
  font-size:18px;
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
	margin-top:-35px;
}
.pp {

	float:left;
	margin-left:-170px;
	margin-top:30px;
	text-align:left;
	color:black;
}
th {
	margin-left:-10px;
}
</style>
</head>
<body>
<div class="cos" style="text-align: center">

<form action="kurswalut.php" method="post">

<br><br><br><input type="submit" class="button" name="button5" value="Wyloguj" />
<input type="submit" class="button" name="button2" value="Cofnij" />
<br><br>
<b><p class="pom">KURS WALUT</p></b>

<p class="pp">
<table>
<tr><th>Nazwa waluty</th><th>Symbol</th><th>Kurs</th></tr>
<tr><td>USD - Stany Zjednoczone Dolar amerykański</td><td>1 USD</td><td>4,0885</td></tr>
<tr><td>EUR - Unia Europejska Euro</td><td>1 EUR</td><td>4,4800</td></tr>
<tr><td>CHF - Szwajcaria Frank szwajcarski</td><td>1 CHF</td><td>4,2226</td></tr>
<tr><td>GBP - Wielka Brytania Funt szterling</td><td>1 GBP</td><td>5,0298</td></tr>
<tr><td>THB - Tajlandia Bat tajlandzki</td><td>1 THB</td><td>0,1282</td></tr>
<tr><td>AUD - Australia Dolar australijski</td><td>1 AUD</td><td>2,7075</td></tr>
<tr><td>HKD - HongKong Dolar hongkoński</td><td>1 HKD</td><td>0,5274</td></tr>
<tr><td>CAD - Kanada Dolar kanadyjski</td><td>1 CAD</td><td>2,9442</td></tr>
<tr><td>NZD - Nowa Zelandia Dolar nowozelandzki</td><td>1 NZD</td><td>2,5249</td></tr>
<tr><td>SGD - Singapur Dolar singapurski</td><td>1 SGD</td><td>2,8818</td></tr>
<tr><td>HUF - Węgry Forint węgierski</td><td>100 HUF</td><td>1,2814</td></tr>
<tr><td>UAH - Ukraina Hrywna ukraińska</td><td>1 UAH</td><td>0,1519</td></tr>
<tr><td>JPY - Japonia Jen japoński</td><td>100 JPY</td><td>3,7947</td></tr>
<tr><td>CNY - Chiny Juan chiński</td><td>1 CNY</td><td>0,5732</td></tr>
<tr><td>CZK - Czechy Korona czeska</td><td>1 CZK</td><td>0,1650</td></tr>
</table>
</p>

<?php

if (isset($_POST['button5'])) {
	header('Location: index.php');
}

	
if (isset($_POST['button2'])) {
	header('Location: konto.php');
}

?>


</form>
</div>
</body>
</html>

