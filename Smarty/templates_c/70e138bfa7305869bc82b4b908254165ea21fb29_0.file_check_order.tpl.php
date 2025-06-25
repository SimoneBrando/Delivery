<?php
/* Smarty version 5.5.1, created on 2025-06-24 17:14:08
  from 'file:check_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ac0c0d608d8_07678865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70e138bfa7305869bc82b4b908254165ea21fb29' => 
    array (
      0 => 'check_order.tpl',
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
function content_685ac0c0d608d8_07678865 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/check_order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>

    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main>
        <section class="cart-section">
            <div class="cart-container">
                <div class="order-card">
                    <div class="order-header">
                        <h2>Riepilogo ordine</h2>
                        <span class="order-date" id="order-date">--</span>
                    </div>
                    <div class="order-items">
                        <strong>Prodotti:</strong>
                        <ul id="cart-items">
                            <!-- JS inserirà qui i prodotti -->
                        </ul>
                        <p class="total-amount"><strong>Totale:</strong> €<span id="total-amount">0.00</span></p>
                    </div>
                    <!-- Form nascosto per l'invio dei dati -->
                    <form id="cartForm" method="POST" action="/Delivery/Ordine/confirmPayment">
                        <input type="hidden" name="cart_data" id="cartDataInput">
                        <input type="hidden" name="created_at" id="createdAtInput">

                        <!-- Sezione Note -->
                        <div>
                            <label for="note">Inserisci Note</label>
                            <input type="text" name="note" id="note" value="">
                        </div>

                        <!-- Sezione Indirizzi -->
                        <div class="address-section">
                            <h3>Seleziona indirizzo di consegna</h3>
                            <div class="radio-group">
                                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('indirizzi')) > 0) {?>
                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('indirizzi'), 'indirizzo');
$_smarty_tpl->getVariable('indirizzo')->index = -1;
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('indirizzo')->value) {
$foreach0DoElse = false;
$_smarty_tpl->getVariable('indirizzo')->index++;
$_smarty_tpl->getVariable('indirizzo')->first = !$_smarty_tpl->getVariable('indirizzo')->index;
$foreach0Backup = clone $_smarty_tpl->getVariable('indirizzo');
?>
                                        <div class="radio-option">
                                            <input type="radio" id="indirizzo_<?php echo $_smarty_tpl->getValue('indirizzo')->getId();?>
" name="indirizzo_id" value="<?php echo $_smarty_tpl->getValue('indirizzo')->getId();?>
" <?php if ($_smarty_tpl->getVariable('indirizzo')->first) {?>checked<?php }?>>
                                            <label class="radio-label" for="indirizzo_<?php echo $_smarty_tpl->getValue('indirizzo')->getId();?>
">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <?php echo $_smarty_tpl->getValue('indirizzo')->getVia();?>
, 
                                                <?php echo $_smarty_tpl->getValue('indirizzo')->getCivico();?>
, 
                                                <?php echo $_smarty_tpl->getValue('indirizzo')->getCitta();?>

                                            </label>
                                        </div>
                                    <?php
$_smarty_tpl->setVariable('indirizzo', $foreach0Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                <?php } else { ?>
                                    <p>Nessun indirizzo registrato.</p>
                                <?php }?>
                                <a href="/Delivery/User/showAddressForm/" class="add-new-btn btn-link">
                                    <i class="fas fa-plus"></i> Aggiungi nuovo indirizzo
                                </a>
                            </div>
                        </div>

                        <!-- Sezione Carte di Credito -->
                        <div class="credit-cards-section">
                            <h3>Seleziona metodo di pagamento</h3>
                            <div class="radio-group">
                                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('carte_credito')) > 0) {?>
                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('carte_credito'), 'carta');
$_smarty_tpl->getVariable('carta')->index = -1;
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('carta')->value) {
$foreach1DoElse = false;
$_smarty_tpl->getVariable('carta')->index++;
$_smarty_tpl->getVariable('carta')->first = !$_smarty_tpl->getVariable('carta')->index;
$foreach1Backup = clone $_smarty_tpl->getVariable('carta');
?>
                                        <div class="radio-option">
                                            <input type="radio" id="carta_<?php echo $_smarty_tpl->getValue('carta')->getNumeroCarta();?>
" name="numero_carta" value="<?php echo $_smarty_tpl->getValue('carta')->getNumeroCarta();?>
" <?php if ($_smarty_tpl->getVariable('carta')->first) {?>checked<?php }?>>
                                            <label class="radio-label" for="carta_<?php echo $_smarty_tpl->getValue('carta')->getNumeroCarta();?>
">
                                                <i class="far fa-credit-card"></i>
                                                <?php echo $_smarty_tpl->getValue('carta')->getNomeIntestatario();?>

                                                •••• •••• •••• <?php echo substr((string) $_smarty_tpl->getValue('carta')->getNumeroCarta(), (int) -4);?>

                                                (<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('carta')->getDataScadenza(),"m/y");?>
)
                                            </label>
                                        </div>
                                    <?php
$_smarty_tpl->setVariable('carta', $foreach1Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                <?php } else { ?>
                                    <p>Nessuna carta di credito registrata.</p>
                                <?php }?>
                                <a href="/Delivery/User/showCreditCardForm/" class="add-new-btn btn-link">
                                    <i class="fas fa-plus"></i> Aggiungi nuova carta
                                </a>
                            </div>
                        </div>

                        <!-- Sezione Orario Consegna -->
                        <div class="delivery-time-options">
                            <strong>Scegli l'orario di consegna:</strong>
                            <div>
                                <input type="radio" id="default-time" name="delivery_time_option" value="default" checked>
                                <label id="default-time-label" for="default-time">Orario proposto: --:--</label>
                            </div>
                            <div>
                                <input type="radio" id="custom-time" name="delivery_time_option" value="custom">
                                <label for="custom-time">Scegli un altro orario</label>
                                <input type="datetime-local" id="custom-delivery-time" name="custom_delivery_time"  
                                       style="display: none;">
                            </div>
                        </div>
                        <input type="hidden" name="dataConsegna" id="dataConsegna">

                        <button onclick="submitCart()" id="checkout-button" class="checkout-button">Procedi al pagamento</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/cart.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/check_order.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
