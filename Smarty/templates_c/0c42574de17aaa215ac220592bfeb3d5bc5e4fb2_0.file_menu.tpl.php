<?php
/* Smarty version 5.5.1, created on 2025-06-04 16:37:40
  from 'file:menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68405a3495e777_89301802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c42574de17aaa215ac220592bfeb3d5bc5e4fb2' => 
    array (
      0 => 'menu.tpl',
      1 => 1749047858,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68405a3495e777_89301802 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/layout.css">
    <?php echo '<script'; ?>
 src="../Js/loadComponents.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <!-- Header -->
    <div id="header-placeholder"></div>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="menu-section">
            <h1>Menù</h1>

            <h1>Ciao <?php echo $_smarty_tpl->getValue('menu');?>
!</h1>
        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>
</body>
</html>
<?php }
}
