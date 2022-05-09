<?php
function account_registration ()
{
    if (isset($_POST['button']))
    {
        $name = $_POST['imie'];
        $surname = $_POST['nazwisko'];
        $pesel = $_POST['pesel'];
        $address = $_POST['adres'];
        $email = $_POST['email'];
        $place_of_residence = $_POST['miejscowosc'];
        $phone_number = $_POST['telefon'];
        $login = $_POST['login'];
        $password = $_POST['haslo'];
        $zip_code = $_POST['kod_pocztowy'];
        $data_processing = @$_POST['ODO'];

        if ($data_processing) $data_processing = "TAK";
        else $data_processing = "NIE";

        $error = "";
        if ($name == ""
            || $surname == ""
            || $address == ""
            || $zip_code == ""
            || $place_of_residence == ""
            || $email == ""
            || $login == ""
            || $password == ""
            || $pesel == ""
        ) $error .= "Pola wymagane muszą być wypełnione<br>";

        if (!is_numeric($phone_number) && !empty($phone_number)) $error .= "Błędnie podany numer telefonu<br>";
        if (!is_numeric($pesel) && !empty($pesel)) $error .= "Błędnie podany pesel<br>";

        if (!preg_match("/^([a-z|A-Z|0-9|.|_]*)@([a-z|0-9]*).([a-z]{2,3})$/", $email) && !empty($email)) $error .= "Błędnie podany adres e-mail<br>";

        if (!preg_match("/^([0-9]{2})-([0-9]{3})$/", $zip_code) && !empty($zip_code)) $error .= "Błędnie podany kod pocztowy<br>";

        $db = mysqli_connect("127.0.0.1", "root", "", "bank");

        if ($db)
        {
            $check_login = "select * from dane where Login=$login";
            $result_login = mysqli_query($db, $check_login);
            if ($result_login == true) $error .= "Taki login już istnieje";
            mysqli_close($db);
        }

        if (empty($error))
        {
            $account_number = "9";
            for ($i = 1; $i <= 25; $i++)
            {
                $random = rand(0, 9);
                $account_number = $account_number . $random;
            }
            $amount_money = 0;
            for ($i = 1; $i <= 4; $i++)
            {
                $random = rand(1, 9);
                $amount_money = $amount_money . $random;
            }

            $db_2 = mysqli_connect("127.0.0.1", "root", "", "bank");

            if ($db_2)
            {
                mysqli_set_charset($db_2, "utf8");
                $ip = $_SERVER['REMOTE_ADDR'];
                $insert_to_dane = "insert into dane values('','" . $name . "','" . $surname . "','" . $pesel . "','" . $address . "','" . $place_of_residence . "','" . $zip_code . "','" . $email . "','" . $phone_number . "','" . $login . "','" . $password . "','" . $data_processing . "')";
                $create_login = "create table $login (NKB varchar(26),Imie varchar(30),Nazwisko varchar(30),Login varchar(30),Kwota_zl float(8,2),Pozyczka float(8,2))";
                $create_login_od = "create table " . $login . "_przelewy_od (NKB_od varchar(26),Imie varchar(30),Nazwisko varchar(30),Data date ,Godzina varchar(20),Kwota float(8,2), Komentarz varchar(150))";
                $create_login_do = "create table " . $login . "_przelewy_do (NKB_do varchar(26),Imie varchar(30),Nazwisko varchar(30),Data date ,Godzina varchar(20),Kwota float(8,2), Komentarz varchar(150))";
                $insert_to_login = "insert into $login values ('" . $account_number . "','" . $name . "','" . $surname . "','" . $login . "','" . $amount_money . "','" . $data_processing . "')";

                $querry_result = mysqli_query($db_2, $insert_to_dane);
                if ($querry_result) header('Location: dziekujemy.html');
                else echo "<br> blad 1";

                $querry_result = mysqli_query($db_2, $create_login);
                if ($querry_result) header('Location: dziekujemy.html');
                else echo "<br> blad 2";

                $querry_result = mysqli_query($db_2, $create_login_od);
                if ($querry_result) header('Location: dziekujemy.html');
                else echo "<br> blad 3";

                $querry_result = mysqli_query($db_2, $create_login_do);
                if ($querry_result) header('Location: dziekujemy.html');
                else echo "<br> blad 4";

                $querry_result = mysqli_query($db_2, $insert_to_login);
                if ($querry_result) header('Location: dziekujemy.html');
                else echo "<br> blad 5";

                mysqli_close($db_2);
            } else echo "Brak połączenia z bazą danych";

        } else echo $error;
    }
}
account_registration();
?>