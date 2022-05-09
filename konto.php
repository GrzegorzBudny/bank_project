<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, konto">
    <meta name="description" content="Strona glowna konta w banku">
    <title>Konto</title>
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
#button2 {
width: 120px;
height: 35px;
background-color:red;
float:right;
margin-right:10px;
}  
h1{
float:left;
margin-left:50px;
}
.square {
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
.hh2 {
	float:left;
	margin-left:30px;
}

</style>
</head>
<body>
<div class="square" style="text-align: center">

<form action="konto.php" method="post">

<br><br><br><input type="submit" class="button" name="button5" value="Wyloguj" />
<input type="submit" class="button" name="button2" value="Przelew" />
<input type="submit" class="button" name="button3" value="Odebrane" />
<input type="submit" class="button" name="button4" value="Wysłane" />
<input type="submit" class="button" name="button6" value="Pozyczki" />
<input type="submit" class="button" name="button7" value="Pomoc" />
<input type="submit" class="button" name="button8" value="Kurs walut" />

<?php

function show_account_data()
{
    session_start();
    $login=$_SESSION['nazwa'];
    echo "<br><br><br><br><br><h2>Witaj ";
    $db = mysqli_connect("localhost", "root", "", "bank");

    if ($db == true)
    {
        $table_dane_db = "select * from dane";
        $querry_result = mysqli_query($db, $table_dane_db);
        while ($data_from_db = mysqli_fetch_assoc($querry_result))
        {
            $name_db = $data_from_db['Imie'];
            $surname_db = $data_from_db['Nazwisko'];

                echo "$name_db  $surname_db :)";

            $table_login_db = "select * from $login";
            $querry_result = mysqli_query($db, $table_login_db);

            while ($data_from_db = mysqli_fetch_assoc($querry_result))
            {
                $account_number = $data_from_db['NKB'];
                $account_cash = $data_from_db['Kwota_zl'];

                echo "<br><br><h1>Numer konta: $account_number  <br><br>Ilość pieniędzy: $account_cash zł";
            }
        }
        mysqli_close($db);
    }
}
function go_to_other_pages()
{
    if (isset($_POST['button5'])) header('Location: index.php');

    if (isset($_POST['button2'])) header('Location: przelew.php');

    if (isset($_POST['button3'])) header('Location: odebrane.php');

    if (isset($_POST['button4'])) header('Location: wyslane.php');

    if (isset($_POST['button6'])) header('Location: pozyczki.php');

    if (isset($_POST['button7'])) header('Location: pomoc.php');

    if (isset($_POST['button8'])) header('Location: kurswalut.php');

}

show_account_data();
go_to_other_pages();
?>

</div>
</form>
</body>
</html>

