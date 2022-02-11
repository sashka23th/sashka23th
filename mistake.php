<?php
//$json = json_encode(array('data' => $array));
    $money =  file_get_contents("data.json");
    $money =  json_decode($money);
    $money[0]->maya -= 0.02;
    $money[0]->maya = round($money[0]->maya,2);
    if($money[0]->maya < 0)
        $money[0]->maya = 0;
    echo $money[0]->maya;
    $money =  json_encode($money);
    file_put_contents("data.json",$money);
?> 