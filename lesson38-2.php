<?php

function getRestFromPage($page)
{
    $subject = file_get_contents('https://restoran.kz/restaurant?page=' . $page);
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
   return $rests;
    
}
print_r(getRestFromPage(15));

  

