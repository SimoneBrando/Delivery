<?php
/* Smarty version 5.5.1, created on 2025-07-02 11:46:12
  from 'file:fatal_error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6864ffe40dd3b7_99657397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '184a3a4cffb9be7e422c469c139684c31825bc68' => 
    array (
      0 => 'fatal_error.tpl',
      1 => 1751368391,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6864ffe40dd3b7_99657397 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Negato</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
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
. La invitiamo a tornare alla Homepage.</p>

                <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <?php if ($_smarty_tpl->getValue('cartError')) {?>
        <?php echo '<script'; ?>
>
            localStorage.removeItem('cart');
            localStorage.removeItem('cart_createdAt');
        <?php echo '</script'; ?>
>
    <?php }?>

</body>
</html><?php }
}
