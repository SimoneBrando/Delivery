<?php

//autoload di Composer
require_once __DIR__ . '/vendor/autoload.php';

use Smarty\Smarty;


function getSmartyInstance() : Smarty {
    $smarty = new Smarty();

    $baseDir = realpath(__DIR__);

    $smarty->setTemplateDir($baseDir . '/Smarty/templates/');
    $smarty->setCompileDir($baseDir . '/Smarty/templates_c/');
    $smarty->setCacheDir($baseDir . '/Smarty/cache/');
    $smarty->setConfigDir($baseDir . '/Smarty/configs/');

    return $smarty;
}

