<?php
//$json = json_encode(array('data' => $array));
    $money =  file_get_contents("data.json");
    $money =  json_decode($money);
    $money[0]->maya += round(0.04,2);
    echo $money[0]->maya;
    $money =  json_encode($money);
    file_put_contents("data.json",$money);
?>