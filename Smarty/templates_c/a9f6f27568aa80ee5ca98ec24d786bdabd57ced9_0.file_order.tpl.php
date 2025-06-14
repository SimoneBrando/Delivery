<?php
/* Smarty version 5.5.1, created on 2025-06-14 19:23:21
  from 'file:order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684db0099ca126_55464711',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9f6f27568aa80ee5ca98ec24d786bdabd57ced9' => 
    array (
      0 => 'order.tpl',
      1 => 1749921780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684db0099ca126_55464711 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/order.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/Smarty/css/layout.css" />
</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="menu-section">
            <h1>Ordina dal menù</h1>

            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('menu'), 'categoria');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('categoria')->value) {
$foreach0DoElse = false;
?>
                <div class="menu-category">
                    <h2>
                        <?php if ($_smarty_tpl->getValue('categoria')['categoria'] == "PIZZE") {?><i class="fas fa-pizza-slice"></i><?php }?>
                        <?php if ($_smarty_tpl->getValue('categoria')['categoria'] == "CALZONI") {?><i class="fas fa-bread-slice"></i><?php }?>
                        <?php if ($_smarty_tpl->getValue('categoria')['categoria'] == "CONTORNI") {?><i class="fas fa-carrot"></i><?php }?>
                        <?php if ($_smarty_tpl->getValue('categoria')['categoria'] == "BEVANDE") {?><i class="fas fa-glass-whiskey"></i><?php }?>
                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('categoria')['categoria'], ENT_QUOTES, 'UTF-8', true);?>

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
                                <button class="add-button" data-id="<?php echo $_smarty_tpl->getValue('piatto')['id'];?>
">+</button>
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

    <div id="cart-icon" class="cart-icon hidden">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-badge">0</span>
    </div>

    <div id="cart" class="cart">
        <h2>Il tuo ordine</h2>
        <ul id="cart-items"></ul>
        <p id="cart-total">Totale: €0.00</p>
        <a href="checkout.html"><button>Prosegui</button></a>
    </div>

    <div id="product-modal" class="modal hidden">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>

    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>


    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>

</body>

<?php echo '<script'; ?>
 src="/Smarty/Js/cart.js" defer><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    document.addEventListener("DOMContentLoaded", function() {
        cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
        renderCart();
        showCartIcon();
    });
<?php echo '</script'; ?>
>
</html>
<?php }
}
