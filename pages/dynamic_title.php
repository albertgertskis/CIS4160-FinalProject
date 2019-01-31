<?php

function title($str) {
    if(empty($str)) {
        $str = "Pokedex Database";
    }
    echo $str;
}