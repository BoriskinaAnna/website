<?php

	$file =fopen("myText.txt", "r");
	$string = file_get_contents("myText.txt");
	fclose($file);

	$number_words = 1;
	$number_letters = 0;
	$count_O = 0;
	for ($i = 0 ; $i < strlen($string); $i++) {
		if ($string[$i] != ' ' ){
		    if ($string[$i] == '!' or $string[$i] == ',' or $string[$i] == '.' or $string[$i] == '\'' or $string[$i] == '?'){
		        $number_letters ++;
		        echo $string[$i];
		        continue;
            }
		    if ( ord($string[$i]) == 206 or ord($string[$i]) == 238)
            {
                $count_O ++;
            }
		        if ($string[$i] == 'o' or $string[$i] == 'O' ){
				$count_O ++;
			}
			$number_letters ++;
			if ($number_words % 3 == 0){
				$string[$i] = mb_strtoupper($string[$i]);
			}
			if ($number_letters % 3 == 0){
				echo "<font color=\"BE00BE\">$string[$i]</font>" ;
			}
			else {
				echo $string[$i];

			}
           // echo ord($string[$i]);

		}
		else {
			$number_words ++;
			$number_letters = 0;
			echo ' ';
		}
	}

	echo "<br/>Count letters O and o - $count_O";
