<?php
/* Smarty version 5.5.1, created on 2025-06-27 18:55:39
  from 'file:confermed_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ecd0b4dfc32_94254194',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f3f17cf2e66324b15069bdd41cb42f980767cf6' => 
    array (
      0 => 'confermed_order.tpl',
      1 => 1751039408,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685ecd0b4dfc32_94254194 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma Ordine</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <link rel="stylesheet" href="/Smarty/css/confirm.css">
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
                <h1>Ordine Confermato</h1>

                <p>Il suo ordine è andato a buon fine! Grazie per aver scelto noi.</p>

                <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <?php echo '<script'; ?>
>
        document.addEventListener("DOMContentLoaded", () => {
            localStorage.removeItem("cart");
            localStorage.removeItem("cart_createdAt");
        });
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js" defer><?php echo '</script'; ?>
>
</body>
</html><?php }
}
