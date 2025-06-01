<?php
/* Smarty version 5.5.1, created on 2025-06-01 17:37:23
  from 'file:prova.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_683c73b3097dd1_70801545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '320b4c4f39dfef8f6a609991f41e4dca7105fa5b' => 
    array (
      0 => 'prova.tpl',
      1 => 1748791309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_683c73b3097dd1_70801545 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/simone/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $_smarty_tpl->getValue('titolo');?>
</title>
</head>
<body>
  <h1>Ciao <?php echo $_smarty_tpl->getValue('nome');?>
!</h1>
</body>
</html>
<?php }
}
