<?php
require_once __DIR__ . '/../config_smarty.php';

$smarty = getSmartyInstance();

$smarty->assign('titolo', 'Prova Smarty');
$smarty->assign('nome', 'Simone');

$smarty->display('prova.tpl');

