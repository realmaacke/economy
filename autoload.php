<?php

spl_autoload_register(function($class) 
{   //auto load classes
    require_once  'classes/'.$class.'.php';
});

function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}