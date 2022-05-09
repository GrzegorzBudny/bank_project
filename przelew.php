<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, przelew">
    <meta name="description" content="Strona przelew">
    <title>Przelew</title>
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
.przycisk3 {
width: 140px;
height: 65px;
background-color:red;
float:right;
margin-right:10px;
}
h1, .hh2{
float:left;
margin-left:30px;
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

<form action="przelew.php" method="post">

<br><br><br><input type="submit" class="przycisk" name="button5" value="Wyloguj" />
<input type="submit" class="przycisk" name="button2" value="Cofnij" />
<?php
session_start();
$login=$_SESSION['nazwa'];
echo "<h2>Witaj ";
$db=mysqli_connect("localhost","root","","bank");

if($db==true)
{
    $querry = "select * from dane";
    $querry_result = mysqli_query($db, $querry);
    while ($data_from_db = mysqli_fetch_assoc($querry_result))
    {
        $name_db = $data_from_db['Imie'];
        $surname_db = $data_from_db['Nazwisko'];

        if ($login==$data_from_db['Login'])
        {
            echo "$name_db  $surname_db :)";
        }
    }

    if (isset($_POST['button5'])) header('Location: index.php');

    if ($db == true)
    {
        $querry = "select * from $login";
        $querry_result = mysqli_query($db, $querry);

        while ($data_from_db = mysqli_fetch_assoc($querry_result))
        {
            $account_number = $data_from_db['NKB'];
            $money_db = $data_from_db['Kwota_zl'];
        }
    }

if (isset($_POST['button2'])) header('Location: konto.php');

?>
<br><br>
<h2 class="hh2">Podaj numer konta : <input type="text" name="nkb" size="28" maxlength="26"/></h2><br><br><br><br>
<h2 class="hh2">Podaj login : <input type="text" name="log" size="26"/></h2><br><br><br><br>
<h2 class="hh2">Kwota : <input type="text" name="kwota"/></h2><br><br><br><br>
<h2 class="hh2">Komentarz : <textarea name="komen" rows="4" cols="50"/></textarea></h2>
<br><br><br><br><br><input type="submit" class="przycisk3" name="button3" value="Wykonaj" />
<?php
    if (isset($_POST['button3']))
    {
        $account_number_to=$_POST['nkb'];
        $login_to=$_POST['log'];
        $money_to=$_POST['kwota'];
        $comment_transaction_to=$_POST['komen'];
        $date_now=date("Y-m-d");
        $time_now=date("H:i");

        if($db==true)
        {
            $querry="select * from $login_to";
            $querry_result_to=mysqli_query($db,$querry);

            while($data_from_db=mysqli_fetch_assoc($querry_result_to))
            {
                $name_db_to=$data_from_db['Imie'];
                $surname_db_to=$data_from_db['Nazwisko'];
                $account_number_to=$data_from_db['NKB'];
                $money_db_to=$data_from_db['Kwota_zl'];
            }
        }
        if($db)
        {
            if($money_db<$money_to)
            {
                echo "Nie masz wystarczających środków";
            }
            else
            {
                $money_update= $money_db - $money_to;
                $money_update_to= $money_db_to + $money_to;

                echo "Połączono";
                mysqli_set_charset($db,"utf8");
                $ip=$_SERVER['REMOTE_ADDR'];

                $query1="insert into ".$login_to."_przelewy_od values('".$account_number."','".$name_db."','".$surname_db."','".$date_now."','".$time_now."','".$money_to."','".$comment_transaction_to."')";
                $query2="insert into ".$login."_przelewy_do values('".$account_number_to."','".$name_db."','".$surname_db."','".$date_now."','".$time_now."','".$money_to."','".$comment_transaction_to."')";
                $query4="update `$login_to` set `Kwota_zl` = '".$money_update_to."' where `login`='$login_to'";
                $query3="update `$login` set `Kwota_zl` = '".$money_update."' where `login`='$login'";

                $result=mysqli_query($db,$query1);
                if ($result);
                else echo "<br> blad 1";

                $result=mysqli_query($db,$query2);
                if ($result);
                else echo "<br> blad 2";

                $result=mysqli_query($db,$query3);
                if ($result);
                else echo "<br> blad 3";

                $result=mysqli_query($db,$query4);
                if ($result);
                else echo "<br> blad 4";
            }
        }
    }
    mysqli_close($db);
}
?>

</div>
</form>
</body>
</html>