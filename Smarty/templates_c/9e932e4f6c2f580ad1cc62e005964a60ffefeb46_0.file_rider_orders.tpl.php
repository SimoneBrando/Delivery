<?php
/* Smarty version 5.5.1, created on 2025-07-07 14:58:15
  from 'file:rider_orders.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686bc467941db6_41032558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e932e4f6c2f580ad1cc62e005964a60ffefeb46' => 
    array (
      0 => 'rider_orders.tpl',
      1 => 1751893089,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:error_section.tpl' => 1,
    'file:order_card.tpl' => 3,
    'file:footer.tpl' => 1,
  ),
))) {
function content_686bc467941db6_41032558 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consegne - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/personale_consegne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <main>

        
        <!-- Error Section -->
        <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        <div class="deliveries-container">
            <h2>Ordini Pronti</h2>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                <?php $_smarty_tpl->renderSubTemplate("file:order_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('order'=>$_smarty_tpl->getValue('order'),'showExtraStatuses'=>false), (int) 0, $_smarty_current_dir);
?>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>

        <div class="deliveries-container">
            <h2>Ordini In Consegna</h2>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ordersOnDelivery'), 'order');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach1DoElse = false;
?>
                <?php $_smarty_tpl->renderSubTemplate("file:order_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('order'=>$_smarty_tpl->getValue('order'),'showExtraStatuses'=>true), (int) 0, $_smarty_current_dir);
?>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>

        <div class="deliveries-container">
            <h2>I miei ordini</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('myOrders')) > 0) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('myOrders'), 'order');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach2DoElse = false;
?>
                    <?php $_smarty_tpl->renderSubTemplate("file:order_card.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('order'=>$_smarty_tpl->getValue('order'),'showExtraStatuses'=>false), (int) 0, $_smarty_current_dir);
?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Non hai ordini assegnati al momento.</p>
            <?php }?>
        </div>

    </main>

    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

        <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>Sei sicuro di voler aggiornare lo stato in <strong><span id="modalStatus"></span></strong>?</p>
            <button id="confirmBtn">Conferma</button>
            <button onclick="closeModal()">Annulla</button>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="/Smarty/Js/orders.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/theme.js" defer><?php echo '</script'; ?>
>
</body>


</html>
<?php }
}
