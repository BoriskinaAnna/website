<?php
require_once "lab2new2.html";

    $file =fopen("myText.txt", "r");
    $sourceText = file_get_contents("myText.txt");
    fclose($file);



    $pattern = '/(([A-Z]{2,}[a-z]*)|(([A-Z]+[a-z]*)(([A-Z]+[a-z]*)+))|((([A-z])|(a-z))+\.){2,}((([A-Z])|(a-z))*)|([À-ß]{2,}[à-ÿ]*)|(([À-ß]+[à-ÿ]*)(([À-ß]+[à-ÿ]*)+))|((([À-ß])|(à-ÿ))+\.){2,}((([À-ß])|(à-ÿ))*))/';
    $replacement = '<u>$0</u>';
    $sourceText = preg_replace($pattern, $replacement, $sourceText);

    $sourceText = str_replace(" ","  ", $sourceText );


   $pattern = '/\b(-?\d+([,.]\d+)?)\b/';
   $replacement = '<span style="color: blue">$0</span>';
   $sourceText = preg_replace($pattern, $replacement, $sourceText);

   $pattern = '/\'\s(\s)+/';
   $replacement = '  ';
   $sourceText = preg_replace($pattern, $replacement, $sourceText);

   $pattern = '/(\.{3}|!|\?|\.)/';
   $replacement = '$0</br>';
   $sourceText = preg_replace($pattern, $replacement, $sourceText);





$sourceText = str_replace("  "," ", $sourceText );

echo '<form>';
echo $sourceText;
echo '</form>';




?>

</body>
</html>
