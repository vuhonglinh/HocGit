<?php

function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}

function redirect($key=""){
    if(!empty($key)){
    header("Location: $key");
    }
}