<?php
/* Smarty version 5.5.1, created on 2025-06-07 18:07:40
  from 'file:miei_ordini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684463cc7aa2e2_81171525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bbf3d963d28453d85017cb2ea6f8f1285e3bd8d' => 
    array (
      0 => 'miei_ordini.tpl',
      1 => 1749312433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684463cc7aa2e2_81171525 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/miei_ordini.css">
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
        <section class="orders-section">
            <h1>I Miei Ordini</h1>

            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders')) > 0) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                    <div class="order-card">
                        <div class="order-header">
                            <h2>Ordine #<?php echo $_smarty_tpl->getValue('order')->getId();?>
</h2>
                            <span class="order-date">
                                <?php if ($_smarty_tpl->getValue('order')->getDataEsecuzione()) {?>
                                    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('order')->getDataEsecuzione(),"%d %B %Y");?>

                                <?php } else { ?>
                                    Data non disponibile
                                <?php }?>
                            </span>
                        </div>
                        <div class="order-items">
                            <p>
                                <strong>Prodotti:</strong>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->getProdotti(), 'product', false, NULL, 'prodottiLoop', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach1DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_prodottiLoop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_prodottiLoop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_prodottiLoop']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_prodottiLoop']->value['total'];
?>
                                    <?php echo $_smarty_tpl->getValue('product')->getNome();
if (!($_smarty_tpl->getValue('__smarty_foreach_prodottiLoop')['last'] ?? null)) {?>, <?php }?>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </p>
                            <p><strong>Totale:</strong> €<?php echo $_smarty_tpl->getValue('order')->getCosto();?>
</p>
                            <p><strong>Note:</strong> <?php echo (($tmp = $_smarty_tpl->getValue('order')->getNote() ?? null)===null||$tmp==='' ? "-" ?? null : $tmp);?>
</p>
                            <p><strong>Stato:</strong> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->getStato());?>
</p>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Non hai ancora effettuato ordini.</p>
            <?php }?>

        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>

</body>
</html>
<?php }
}
