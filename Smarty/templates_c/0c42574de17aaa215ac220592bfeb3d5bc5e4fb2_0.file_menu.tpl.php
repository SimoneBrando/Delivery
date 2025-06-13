<?php
/* Smarty version 5.5.1, created on 2025-06-13 11:54:22
  from 'file:menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684bf54ee5ec05_13711117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c42574de17aaa215ac220592bfeb3d5bc5e4fb2' => 
    array (
      0 => 'menu.tpl',
      1 => 1749808442,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684bf54ee5ec05_13711117 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

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
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</body>
</html>

<?php }
}
