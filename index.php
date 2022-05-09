<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Grzegorz Budny">
    <meta name="keywords" content="KGMD, logowanie">
    <meta name="description" content="Strona logowania do banku">
    <title>Logowanie</title>
<style>
body {
background-image: url("background.png");
background-color:black;
}
.button1 {
width: 100px;
height: 35px;
background-color:red;
} 
.square {
width: 450px;
height: 350px;
background: RoyalBlue;
position: absolute;
top: 0;
right: 0;
bottom: 0; 
left: 0;
margin: auto; 
border:outset 10px blue;
}

</style>
</head>
<body>
<div class="square" style="text-align: center">
<form action="index.php" method="post">
<br><br><br><br><br><br>Login:<input type="text" name="loginEntered"/>
<br><br>Haslo:<input type="password" name="passwordEntered"/>

<br><br><input type="submit" class="button1" name="button1" value="Zaloguj" />

<br><br><input type="button" class="button1" value="Zarejestruj"  onClick="location.href='rejestracja/rejestracja.html';"/>
<br>

<?php
function login_to_account()
{
    if (isset($_POST['button1']))
    {
        $db = mysqli_connect("localhost", "root", "", "bank");
        $login_entered = $_POST['loginEntered'];
        $password_entered = $_POST['passwordEntered'];
        $correct_log_and_pass = 0;
        if ($db == true)
        {
            $all_from_dane = "select * from dane";
            $result_all_from_dane = mysqli_query($db, $all_from_dane);

            while ($data_from_db = mysqli_fetch_assoc($result_all_from_dane))
            {
                $password_db = $data_from_db['Haslo'];
                $login_db = $data_from_db['Login'];
                $block_account_db = $data_from_db['Zablokowane'];
                $account_error_db = $data_from_db['blad_logowa'];

                if ($login_entered == $login_db)
                {
                    $correct_log_and_pass = +1;
                }
            }
            if ($block_account_db == "TAK") echo "<br>Zablokowane konto<br> Skontaktuj się z nami: 807 312 123";
            else
            {
                if ($correct_log_and_pass == 1)
                {
                    $correct_log_and_pass = 0;
                } else echo "<br>Zły login lub haslo";

                if ($password_entered == "") echo "<br>Nie wpisałeś hasła";
                else if ($password_entered != $password_db)
                {
                    $account_error_db++;
                    $error_db_increment = "update dane set `blad_logowa` ='" . $account_error_db . "' where `login`='" . $login_entered . "'";
                    $querry_result = mysqli_query($db, $error_db_increment);
                    if ($querry_result) ;
                    else echo "<br> blad 1";

                    if ($account_error_db >= 3)
                    {
                        $account_lock_db = "update dane set `Zablokowane` ='TAK' where `login`='" . $login_entered . "'";
                        $querry_result = mysqli_query($db, $account_lock_db);
                        if ($querry_result) ;
                        else echo "<br> blad 1";
                        echo "<br>Zablokowane konto<br> Skontaktuj się z nami: 807 312 123";
                    } else echo "<br>Złe haslo";
                } else if ($password_entered === $password_db)
                {
                    header('Location: konto.php');
                    $error_db_back_to_zero = "update dane set `blad_logowa` ='0' where `login`='" . $login_entered . "'";
                    $querry_result = mysqli_query($db, $error_db_back_to_zero);
                    if ($querry_result) ;
                    else echo "<br> blad 1";
                }
            }
            session_start();
            $_SESSION['nazwa'] = $login_entered;
            mysqli_close($db);
        }
    }
}
login_to_account();
?>

</form>

</div>
</body>
</html>
