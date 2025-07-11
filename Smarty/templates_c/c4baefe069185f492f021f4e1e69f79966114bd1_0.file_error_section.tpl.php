<?php
/* Smarty version 5.5.1, created on 2025-07-11 01:41:35
  from 'file:error_section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68704faf014eb1_47214874',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4baefe069185f492f021f4e1e69f79966114bd1' => 
    array (
      0 => 'error_section.tpl',
      1 => 1751469988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68704faf014eb1_47214874 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><section class="message-section">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('messages'), 'message', false, 'type');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('type')->value => $_smarty_tpl->getVariable('message')->value) {
$foreach1DoElse = false;
?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('message'), 'msg');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach2DoElse = false;
?>
            <div class="alert alert-<?php echo $_smarty_tpl->getValue('type');?>
"><?php echo $_smarty_tpl->getValue('msg');?>
</div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</section>
<?php }
}
