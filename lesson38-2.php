<?php 
$subject = file_get_contents('https://restoran.kz/restaurant');
$pattern = '/<a class="link-inherit-color" href="(.+?)">(.+?)<\/a>/u';
$matches = [];
preg_match_all($pattern, $subject, $matches);
print_r($matches);
new





