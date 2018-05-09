<?php
require_once "lab2new.html";

    $file =fopen("myText.txt", "r");
    $sourceText = file_get_contents("myText.txt");
    fclose($file);



    $pattern = '/ (-?\d+([,.]\d+)?) /';
    $replacement = '<u>$0</u>';
    $sourceText = preg_replace($pattern, $replacement, $sourceText);

   $sourceText = str_replace(" ","  ", $sourceText );


   $pattern = '/(\b([A-Z][a-z]*)\b)|( ([À-ß¨]{1}[à-ÿ¸]*) )/';
   $replacement = '<span style="color: darkgreen">$0</span>';
   $sourceText = preg_replace($pattern, $replacement, $sourceText);

    $pattern = '/(([A-Z]{2,}[a-z]*)|(([A-Z]+[a-z]*)(([A-Z]+[a-z]*)+))|((([A-z])|(a-z))+\.){2,}((([A-Z])|(a-z))*)|([À-ß]{2,}[à-ÿ]*)|(([À-ß]+[à-ÿ]*)(([À-ß]+[à-ÿ]*)+))|((([À-ß])|(à-ÿ))+\.){2,}((([À-ß])|(à-ÿ))*))/';
    $replacement = '<span style="color: darkred">$0</span>';
    $sourceText = preg_replace($pattern, $replacement, $sourceText);

$sourceText = str_replace("  "," ", $sourceText );

    echo $sourceText;

