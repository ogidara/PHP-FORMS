<?php
$path = "pass.json";
$code = $_POST['code'];
$found = false;

if (!is_null($code)){
    echo($code."\n");

    // Read the JSON file 
    $json = file_get_contents($path);
    
    // Decode the JSON file
    $json_data = json_decode($json, true);

    for($i = 0; $i < count($json_data); ++$i) {
        if($json_data[$i]['code']==trim($code)){
            $found = true;
            echo("code existe\n");
            if($json_data[$i]['lu']==true){
                echo("deja lu\n");
            }else{
                //show link
                echo( $json_data[$i]['lien']."\n");
                //change statut 
                $json_data[$i]['lu']=true;
                // save data after edition
                // Convert JSON data from an array to a string
                $jsonString = json_encode($json_data, JSON_PRETTY_PRINT);
                // Write in the file
                $fp = fopen($path, 'w');
                fwrite($fp, $jsonString);
                fclose($fp);
            }
            break;
        }
    }

    if($found == false){
        echo("Nous n'avons pas ce code");
    }

    // save data after edition
    // Convert JSON data from an array to a string
    // $jsonString = json_encode($json_data, JSON_PRETTY_PRINT);
    // Write in the file
    // $fp = fopen($path, 'w');
    // fwrite($fp, $jsonString);
    // fclose($fp);

    // send to pass link

}else{
    header("form.php");
}



