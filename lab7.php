<?php
require_once "connectionLab7.php";
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));

$res = mysqli_query($link, "SELECT * FROM cookie");

$record = mysqli_fetch_all($res);


$rows = mysqli_num_rows($res);

for ($i =0; $i < $rows; $i++){
    if ($record[$i][2] == 'delete'){

        setcookie($record[$i][0],$record[$i][1],time()-1);
        unset($_COOKIE[$record[$i][0]]);
    }
    else{

        setcookie($record[$i][0],$record[$i][1]);
        $_COOKIE[$record[$i][0] = $record[$i][1]];
    }
}


require_once "lab2new.html";
print_r($_COOKIE);






