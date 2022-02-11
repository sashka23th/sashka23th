<?php
   
        $items = array(4, 6, 8, 9, 10, 12, 14, 15, 16, 18, 20, 21, 24, 25, 27, 28, 30, 32, 35, 36, 40, 42, 45, 48, 49, 54, 56, 63, 64, 72, 81); 

        $n1 = random_int(2, 9);
        $n2 = random_int(2, 9);
        $result['q'] = $n1 . " * ". $n2;
        $result['a'] = $n1 * $n2;
        array_unshift($items, $result['a']); //Добовляем в начло правилный ответ
        $final = array_unique($items); // удаляем копии
        for ($i=0; $i < 19 ; $i++) { 
            array_pop($final);
        }    
        shuffle($final);  //функция перемещает элементы массива в случайном порядке.
        $result['btns'] = $final;

        echo json_encode($result);
