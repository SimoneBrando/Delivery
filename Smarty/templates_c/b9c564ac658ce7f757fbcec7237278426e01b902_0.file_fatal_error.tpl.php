<?php
/* Smarty version 5.5.1, created on 2025-06-25 10:58:06
  from 'file:fatal_error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685bba1ec6a2a8_65738113',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b9c564ac658ce7f757fbcec7237278426e01b902' => 
    array (
      0 => 'fatal_error.tpl',
      1 => 1750602402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685bba1ec6a2a8_65738113 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Negato</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <link rel="stylesheet" href="/Smarty/css/error.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php echo '<script'; ?>
 src="../Js/loadComponents.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <!-- Header -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main>
        <section>
            <div>
                <h1>Problema Insolito</h1>

                <p>C'è stato un problema indesiderato. <?php echo $_smarty_tpl->getValue('message');?>
. La invitiamo a tornare alla Homepage ed eseguire nuovamente l'accesso.</p>

                <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

</body>
</html><?php }
}
