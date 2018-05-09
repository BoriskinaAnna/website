<?php
    require_once "lab2new.html";
    require_once "lab3.html";



    function searchGraphicsFiles($currentAddress)
    {

        global $sizeGraphicFilesInDirectory;
        $arrayFiles = scandir($currentAddress);
        for ($i = 2; $i < count($arrayFiles); $i++) {
            if (is_dir($currentAddress . "\\" . $arrayFiles[$i])) {
                searchGraphicsFiles($currentAddress . "\\" . $arrayFiles[$i]);
            } else {
                $extention = new SplFileInfo($currentAddress . "\\" . $arrayFiles[$i]);
                $extentionToLower = mb_strtolower($extention->getExtension());
                if ($extentionToLower == "bmp" or $extentionToLower == "jpg" or $extentionToLower == "jpeg" or $extentionToLower == "png" or $extentionToLower == "gif") {
                    $stat = stat($currentAddress."\\".$arrayFiles[$i]);
                    $sizeGraphicFilesInDirectory += $stat['size'];
                }


            }

        }
    }



    function dir_size($dirname) {
        $totalsize=0;
        if ($dirstream = @opendir($dirname)) {
            while (false !== ($filename = readdir($dirstream))) {
                if ($filename!="." && $filename!="..")
                {
                    if (is_file($dirname."/".$filename))
                        $totalsize+=filesize($dirname."/".$filename);

                    if (is_dir($dirname."/".$filename))
                        $totalsize+=dir_size($dirname."/".$filename);
                }
            }
        }
        closedir($dirstream);
        return $totalsize;
    }




    function searchIcon ($address){
        $extention = new SplFileInfo($address);

        switch (mb_strtolower($extention->getExtension())){
            case "txt":{
                echo '<img src="images/txtIcon.png" width="30" height="30" align="left">';
                $filePointer = fopen($address, 'r');
                $text = fgets($filePointer, 100);
                echo "<br/>".$text;
                fclose($filePointer);
                break;
            }
            case "bmp":
            case "jpg":
            case "jpeg":
            case "png":{
                echo '<img src="images/graphicIcon.png" width="30" height="30" align="left">';
                break;
            }
            case "html":{
                echo '<img src="images/htmlIcon.png" width="30" height="30" align="left">';
                break;
            }
            case "php":
            case "css":{
                echo '<img src="images/phpStormIcon.png" width="30" height="30" align="left">';
                break;
            }
            default:{
                if (is_file($address)){
                    echo '<img src="images/unknowFileIcon.jpg" width="30" height="30" align="left">';
                }
                else{
                    echo '<img src="images/folderIcon.png" width="30" height="30" align="left">';
                }

            }
        }
    }

 function Main($address){

     global $sizeFilesInDirectory, $sizeGraphicFilesInDirectory ;
     $arrayFiles = scandir($address);
     for ($i = 2; $i < count($arrayFiles); $i++){

         echo "<br/>".$address."\\".$arrayFiles[$i];
         searchIcon($address."\\".$arrayFiles[$i]);

         $stat = stat($address."\\".$arrayFiles[$i]);

         if (is_dir($address."\\".$arrayFiles[$i])){

             echo  "<br/>"."File size: ".round(dir_size($address."\\".$arrayFiles[$i])/1024)."KB";
             $sizeFilesInDirectory += dir_size($address."\\".$arrayFiles[$i]);
         }
         else{
             $sizeFilesInDirectory += $stat['size'];
             if ($stat['size']/1024 > 1){
                 echo "<br/>"."File size: ".round($stat['size']/1024)."KB";
             }
             else{
                 echo "<br/>"."File size: ".round($stat['size'])."B";
             }
         }

         echo "<br/>"."The file is created: ".date ("F d Y H:i:s.",$stat['atime']);
         echo "<br/>"."The file is opened: ".date ("F d Y H:i:s.",$stat['ctime']);
         echo "<br/>"."The file is changed: ".date ("F d Y H:i:s.",$stat['mtime']);

     }

     searchGraphicsFiles($address);

     echo $address;

     echo "<br/>"."<br/>"."The percentage of the volume of the graphic files to the total amount of data: ".(number_format(($sizeGraphicFilesInDirectory/$sizeFilesInDirectory)*100, 2))."%";

 }



    if ($_POST){
        $address = $_POST['address'];
        if (is_dir($address)){
            $sizeFilesInDirectory = 0;
            $sizeGraphicFilesInDirectory = 0;
            Main($address);
        }
        else{
            echo "This isn't a directory";
        }

    }
