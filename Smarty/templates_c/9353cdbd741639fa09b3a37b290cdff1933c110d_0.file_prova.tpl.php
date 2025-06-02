<?php
/* Smarty version 5.5.1, created on 2025-06-01 19:25:36
  from 'file:prova.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_683c8d109e85d2_69601523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9353cdbd741639fa09b3a37b290cdff1933c110d' => 
    array (
      0 => 'prova.tpl',
      1 => 1748793327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_683c8d109e85d2_69601523 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/DELIVERY/Smarty/templates';
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
