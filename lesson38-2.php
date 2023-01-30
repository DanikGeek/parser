<?php

use LDAP\Result;

$subject = file_get_contents('https://restoran.kz/restaurant');
$pattern = '/<div class="mb-5">/u';
$blocks = preg_split($pattern, $subject);
//print_r($blocks);
unset($blocks[0]);

$rests =[];
foreach ($blocks as $block) {
    $pattern = '/<a class="link-inherit-color" href="(.+?)">(.+?)<\/a>/u';
    $result = [];
    preg_match_all($pattern, $block, $result);
    //print_r($result);
    $rest = [
        'name' => $result[2][0],
        'link' => $result[1][0],
    ];
    $pattern = '/<li class="d-flex mr-5 mb-3"><svg class="icon icon_md flex-none mr-3" aria-hidden="true"><use xlink:href="(.+?)"><\/use><\/svg>(.+?)<\/li>/u';
    $result = [];
    preg_match_all($pattern, $block, $result);
    
    //print_r($result);
    $paramsMap = [
        '#icon-plate' => 'cuisine',
        '#icon-kz-tenge-in-circle' => 'price',
        '#icon-lightning-in-circle'   => 'option',
    ];

    foreach ($paramsMap as $k => $v) {  
       $index = array_search($k, $result[1]);
        if ($index !== false) {
            $rest[$v] = $result[2][$index];
        }
    }
    $rests [] = $rest;
   

}
print_r($rests);
die();   




$pattern = '/<a class="link-inherit-color" href="(.+?)">(.+?)<\/a>/u';
$matches = [];
preg_match_all($pattern, $subject, $matches);
//print_r($matches);


$rests = [];
foreach ($matches[2] as $key => $value) {
    $rests[] = [
     'name' => $value,
     'link' => $matches[1][$key],  
    ];
}
print_r($rests);

$subject = file_get_contents('https://restoran.kz/restaurant');
$pattern = '/<li class="d-flex mr-5 mb-3"><svg class="icon icon_md flex-none mr-3" aria-hidden="true"><use xlink:href="(.+?)"><\/use><\/svg>(.+?)<\/li>/u';
$matches = [];
preg_match_all($pattern, $subject, $matches);
echo "matches- ";
print_r($matches[2]);

foreach ($rests as $key => $value) {
    $rests[$key]['cuisine'] = $matches[2][$key*3];
    $rests[$key]['price'] = $matches[2][$key*3+1];
    $rests[$key]['option'] = $matches[2][$key*3+2];
}
echo "rests- ";
print_r($rests);
