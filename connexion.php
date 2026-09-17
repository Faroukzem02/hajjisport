<?php
    $db_name = 'mysql:host=localhost;dbname=hajji_sports';
    $db_user = "root";
    $db_password = "";

    $conn = new PDO($db_name,$db_user,$db_password);

    function uniq_id(){
        $numbers = '123456789';
        $numbersLength = strlen($numbers);
        $randomString = '';
        for($i=0 ; $i<5 ; $i++){
            $randomString.=$numbers[mt_rand(0,$numbersLength-1)];
        }  
        return $randomString;
    }
?>
