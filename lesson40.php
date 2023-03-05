<?php
include './functions.php';
include './db.php';

  $rests = [];
  for ($i=1; $i <= $max; $i++) { 
  $rests = array_merge($rests, getRestFromPage($i));
  }
$stmt = $pdo->prepare("TRUNCATE TABLE `cg_rests`.`rests`"); 
$stmt->execute();

  # Подготовка запроса
  $stmt = $pdo->prepare("
    INSERT INTO
        `rests` (
            `name`,
            `link`,
            `cuisine`,
            `price`,
            `options`
        ) VALUES (
            :name,
            :link,
            :cuisine,       
            :price,
            :options
        )

  ");
  #Выплнение запроса    

foreach ($rests as $rest) {
    $stmt->execute([
        ':name' => $rest['name'] ?? '',
        ':link' => $rest['link'] ?? '',
        ':cuisine' => $rest['cuisine'] ?? '', //Сокращение тернарного оператора
        ':price' => isset($rest['price']) ? $rest['price'] : '' ,
        ':options' => isset($rest['options']) ? $rest['options'] : '', 
    
      ]);
}

  //print_r($rests);
  //insert select update delete
// пароль от PHPMyAdmin root Atbasar123 - на OpenServer
//Поток #58
//Урок 35. Обращаемся к БД за данными.
//Часть 2. Запрос на выборку данных.
//9:54
