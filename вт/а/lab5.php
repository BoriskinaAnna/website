<?php
require_once "lab2new.html";
require_once 'connection.php'; // подключаем скрипт

    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

    // выполняем операции с базой данных
    $res = mysqli_query($link, "SHOW TABLES FROM `store`");
    $record = mysqli_fetch_all($res);

if($res)
{
    for ($k = 0; $k < count($record); $k++){
        $table = mysqli_query($link, "SELECT * FROM `".$record[$k][0]."`");

        $type = mysqli_query($link, "SHOW FIELDS FROM `".$record[$k][0]."`");
        $temp =  mysqli_fetch_all($type);
       // print_r($temp);

        echo "</br>";

            $rows = mysqli_num_rows($table); // количество полученных строк
            $countRows = mysqli_num_fields($table);
            echo "<table><tr>";
            for ($i = 0; $i < count($temp); $i++){
                echo "<th>".$temp[$i][0]."[".$temp[$i][1].";".$temp[$i][3]."]"."</th>";
            }
            echo "</tr>";


            for ($i = 0 ; $i < $rows ; ++$i)
            {
                $row = mysqli_fetch_row($table);

                // print_r($row);
                echo "<tr>";
                for ($j = 0 ; $j < $countRows ; $j++) echo "<td>$row[$j]</td>";
                echo "</tr>";
            }
       // }

    }

    echo "</table>";

    // очищаем результат
    mysqli_free_result($res);
}

   // print_r($record);
    // закрываем подключение
    mysqli_close($link);

