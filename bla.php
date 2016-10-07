<?php

# Добавляет тект
function addText (&$image, $font, $fontSize = 38, $textWidth = 100, $padding = 10, $textPadding = 40, $color, $text) {

    $i = 1;
    foreach (explode(PHP_EOL, wordwrap($text, $textWidth, PHP_EOL)) as $key => $word) {

        imagettftext($image, $fontSize , 0, 40, $padding + ($textPadding * $i), $color, $font, $word);
        $i++;

    }


}