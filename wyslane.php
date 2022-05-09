<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, wyslane">
    <meta name="description" content="Strona wyslane">
    <title>Wyslane</title>
<style>
body {
background-image: url("background.png");
background-color:black;
color:white;
}
.przycisk {
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

</style>
</head>
<body>
<div class="cos" style="text-align: center">

<form action="wyslane.php" method="post">

<br><br><br><input type="submit" class="przycisk" name="button5" value="Wyloguj" />
<input type="submit" class="przycisk" name="button2" value="Cofnij" />
<?php
session_start();
$login=$_SESSION['nazwa'];
echo "<h2>Witaj ";
$db=mysqli_connect("localhost","root","","bank");

if($db==true)
{
    $querry="select * from dane";
    $result=mysqli_query($db,$querry);
    while($data_from_db=mysqli_fetch_assoc($result))
    {
	    $name_db=$data_from_db['Imie'];
	    $surname_db=$data_from_db['Nazwisko'];

		if($login==$data_from_db['Login'])
        {
            echo "$name_db  $surname_db :)</h2>";
	    }
    }
?>
<table>
<tr><th>NKB_do</th><th>Imie</th><th>Nazwisko</th><th>Data</th><th>Godzina</th><th>Kwota</th><th>Komentarz</th></tr>
<?php
    if (isset($_POST['button5']))
    {
	header('Location: index.php');
    }

    if (isset($_POST['button2']))
    {
	header('Location: konto.php');
    }

    $db=mysqli_connect("localhost","root","","bank");
	if($db==true)
    {
		$querry="select * from ".$login."_przelewy_do";
		$result=mysqli_query($db,$querry);
        while($data_from_db=mysqli_fetch_assoc($result))
        {
            $account_number_to=$data_from_db['NKB_do'];
            $name_db=$data_from_db['Imie'];
            $surname_db=$data_from_db['Nazwisko'];
            $date_now=$data_from_db['Data'];
            $time_now=$data_from_db['Godzina'];
            $money_db=$data_from_db['Kwota'];
            $comment_db=$data_from_db['Komentarz'];

            echo "<tr><td>$account_number_to</td><td>$name_db </td><td>$surname_db</td><td>$date_now</td><td>$time_now </td><td>$money_db</td><td>$comment_db </td></tr>";
        }
    }  else echo "Błąd połączenia!!!";
mysqli_close($db);
}


?>
</table>


</div>
</form>
</body>
</html>

