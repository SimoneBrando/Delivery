<?php
/* Smarty version 5.5.1, created on 2025-06-27 21:14:26
  from 'file:error_section.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685eed92e901b4_87992380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4baefe069185f492f021f4e1e69f79966114bd1' => 
    array (
      0 => 'error_section.tpl',
      1 => 1751051615,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_685eed92e901b4_87992380 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><section class="error-section">
    <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null))) && $_smarty_tpl->getValue('error') != '') {?>
        <div class="error-message"><?php echo $_smarty_tpl->getValue('error');?>
</div>
    <?php }?>
</section>
<?php }
}
