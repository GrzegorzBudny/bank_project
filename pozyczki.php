<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, pozyczki">
    <meta name="description" content="Strona pozyczania pieniedzy">
    <title>Pozyczki</title>
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
table{ margin:auto;}
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
	margin-top:0;
}
.pp {
	float:left;
	margin-left:50px;
	margin-top:0;
	text-align:left;
	color:black;
}
.wiad {
	float:left;
	margin-left:-390px;
	margin-top:-110px;
	text-align:left;
	color:white;
}
.odd {

	float:left;
	margin-left:-420px;
	margin-top:320px;
	text-align:left;
	color:black;
}
.przycpln {
		float:left;
	margin-left:-140px;
	margin-top:70px;
	text-align:left;
	color:black;
}
</style>
</head>
<body>
<div class="cos" style="text-align: center">

<form action="pozyczki.php" method="post">

<br><br><br><input type="submit" class="button" name="button5" value="Wyloguj" />
<input type="submit" class="button" name="button2" value="Cofnij" />
<p class="pom"><b>POŻYCZKI</b></p>
<p class="przycpln">
<input type="submit" class="button" name="button11" value="2500 PLN" />
<input type="submit" class="button" name="button12" value="2000 PLN" />
<input type="submit" class="button" name="button13" value="1500 PLN" />
<input type="submit" class="button" name="button14" value="1000 PLN" />
<input type="submit" class="button" name="button15" value="500 PLN" />
</p>
<p class="pp">
Każdą z powyższych kwot jest o 5% wyższa przy spłacie (pożyczka 1000zł = oddanie 1050zł)
<br><br><br>W celu uzyskania pożyczki o podanych kwotach zadzwoń pod numer:
<b><br><br>+48 546 112 112 </b>
<br><br><br><br><br>*Aby uzyskać większą pożyczkę udaj się do pobliskiej placówki.
</p>

<p class='wiad'>
<?php
session_start();
$login=$_SESSION['nazwa'];

if (isset($_POST['button5'])) {
	header('Location: index.php');
}

	
if (isset($_POST['button2'])) {
	header('Location: konto.php');
}
$db=mysqli_connect("localhost","root","","bank");

if($db==true)
{
    $table_dane_db="select * from dane";
    $result=mysqli_query($db,$table_dane_db);

    while($data_from_db=mysqli_fetch_assoc($result))
    {
	    $name_db=$data_from_db['Imie'];
	    $surname_db=$data_from_db['Nazwisko'];
    }

    $table_dane_db="select * from $login";
    $result=mysqli_query($db,$table_dane_db);

    while($data_from_db=mysqli_fetch_assoc($result))
    {
	    $account_number_db=$data_from_db['NKB'];
	    $amount_money_db=$data_from_db['Kwota_zl'];
	    $money_loan_db=$data_from_db['Pozyczka'];
	}

    if (isset($_POST['button16']))
    {
        $how_much_donate_db=$_POST['odda'];
        $account_money_update=$amount_money_db-$how_much_donate_db;
        $how_much_donate=$money_loan_db-$how_much_donate_db;
        if($how_much_donate_db<0) echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Nie można wpisywać ujemnych wartości";
        else if($how_much_donate_db>$money_loan_db) echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Za duża kwota";
        else if($how_much_donate_db=="") echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Nic nie wpisałeś";
        else
        {
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";
            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
	}
    if($money_loan_db==0)
    {
        if (isset($_POST['button11']))
        {
            $account_money_update=$amount_money_db+2500;
            $how_much_donate=$money_loan_db+2625;
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";

            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
        if (isset($_POST['button12']))
        {
            $account_money_update=$amount_money_db+2000;
            $how_much_donate=$money_loan_db+2100;
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";
            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
        if (isset($_POST['button13']))
        {
            $account_money_update=$amount_money_db+1500;
            $how_much_donate=$money_loan_db+1575;
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";
            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
        if (isset($_POST['button14']))
        {
            $account_money_update=$amount_money_db+1000;
            $how_much_donate=$money_loan_db+1050;
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";
            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
        if (isset($_POST['button15']))
        {
            $account_money_update=$amount_money_db+500;
            $how_much_donate=$money_loan_db+525;
            $querry_money_update="update `$login` set `Kwota_zl` = '$account_money_update' where `login`='$login'";
            $query_donate_update="update `$login` set `Pozyczka` = '$how_much_donate' where `login`='$login'";
            $querry_result=mysqli_query($db,$querry_money_update);
            if ($querry_result);
            else echo "<br> blad 1";
            $querry_result=mysqli_query($db,$query_donate_update);
            if ($querry_result);
            else echo "<br> blad 2";
        }
	}
	else
    {
		echo "<br>Nie możesz wziąść pożyczki ponieważ już masz jedną";
		$if_have_donate=1;
	}
    mysqli_close($db);
}
    else echo "Błąd połączenia!!!";

?>
</p>

<p class="odd">Ile chcesz oddać 
<?php
echo "(do oddania :$money_loan_db) :";
?>

 <input type="text" name="odda" size="10"/>
<input type="submit" class="button" name="button16" value="Wyślij" /></p>

</div>
</form>
</body>
</html>

