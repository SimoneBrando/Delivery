<?php
/* Smarty version 5.5.1, created on 2025-06-09 10:20:56
  from 'file:menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6846996894b8c7_28182954',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a76fd225865711c5992502a388fbfd2fa38e3c7' => 
    array (
      0 => 'menu.tpl',
      1 => 1749454433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6846996894b8c7_28182954 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <?php echo '<script'; ?>
 src="/Smarty/Js/loadComponents.js" defer><?php echo '</script'; ?>
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

            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('menu'), 'categoria');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('categoria')->value) {
$foreach0DoElse = false;
?>
                <div class="menu-category">
                    <h2><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('categoria')['categoria'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
                    <div class="menu-items">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categoria')['piatti'], 'piatto');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('piatto')->value) {
$foreach1DoElse = false;
?>
                            <div class="menu-item">
                                <div class="item-info">
                                    <h3><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('piatto')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</h3>
                                    <p><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('piatto')['descrizione'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                                </div>
                                <div class="item-price">€<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('piatto')['costo'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                            </div>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>
</body>
</html>

<?php }
}
