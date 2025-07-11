<?php
/* Smarty version 5.5.1, created on 2025-07-11 11:39:57
  from 'file:chef_orders.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870dbed55f297_11735082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'decb6ce08fb6c6ed0387514e5b3b2ce9ea585252' => 
    array (
      0 => 'chef_orders.tpl',
      1 => 1752226681,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:error_section.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6870dbed55f297_11735082 (\Smarty\Template $_smarty_tpl) {
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
        <div class="deliveries-container">

            <!-- Error Section -->
            <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders')) > 0) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                    <div class="delivery-card">
                        <div class="delivery-header">
                            <h3>Ordine #<?php echo $_smarty_tpl->getValue('order')->getId();?>
</h3>
                            <?php $_smarty_tpl->assign('statoClasse', '', false, NULL);?>
                            <?php if ($_smarty_tpl->getValue('order')->getStato() == 'annullato') {?>
                                <?php $_smarty_tpl->assign('statoClasse', 'annullato', false, NULL);?>
                            <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'consegnato') {?>
                                <?php $_smarty_tpl->assign('statoClasse', 'consegnato', false, NULL);?>
                            <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'pronto') {?>
                                <?php $_smarty_tpl->assign('statoClasse', 'pronto', false, NULL);?>
                            <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'in_preparazione') {?>
                                <?php $_smarty_tpl->assign('statoClasse', 'in_preparazione', false, NULL);?>
                            <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'in_attesa') {?>
                                <?php $_smarty_tpl->assign('statoClasse', 'errore', false, NULL);?>
                            <?php }?>
                            <span class="order-status <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('statoClasse'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('order')->getStato(),"_"," "));?>
</span>
                        </div>
                        <div class="delivery-info">
                            <p><strong>Note:</strong> <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('order')->getNote(), ENT_QUOTES, 'UTF-8', true);?>
</p>
                            <p><strong>Data esecuzione:</strong> <?php echo $_smarty_tpl->getValue('order')->getDataEsecuzione()->format('d/m/Y H:i:s');?>
</p>
                            <p><strong>Data ricezione:</strong> <?php echo $_smarty_tpl->getValue('order')->getDataRicezione()->format('d/m/Y H:i:s');?>
</p>
                            <p><strong>Costo totale:</strong> €<?php echo $_smarty_tpl->getValue('order')->getCosto();?>
</p>
                            <p><strong>Prodotti:</strong></p>
                            <ul>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->getItemOrdini(), 'itemOrdine');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('itemOrdine')->value) {
$foreach1DoElse = false;
?>
                                    <li class="product-item"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
 - qty: <?php echo $_smarty_tpl->getValue('itemOrdine')->getQuantita();?>
 - €<?php echo $_smarty_tpl->getValue('itemOrdine')->getPrezzoUnitarioAlMomento();?>
</li>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </ul>
                        </div>
                        <form method="POST" action="/Delivery/Chef/cambiaStatoOrdine" class="status-form">
                            <input type="hidden" name="ordineId" value="<?php echo $_smarty_tpl->getValue('order')->getId();?>
">
                            <input type="hidden" name="stato_attuale" value="<?php echo $_smarty_tpl->getValue('order')->getStato();?>
">
                            <label for="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
">Modifica stato:</label>
                            <select name="stato" id="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
" class="status-select">
                                <option value="">-- Seleziona stato --</option>
                                <option value="in_preparazione" <?php if ($_smarty_tpl->getValue('statoClasse') == 'in_preparazione') {?>selected<?php }?>>In Preparazione</option>
                                <option value="pronto" <?php if ($_smarty_tpl->getValue('statoClasse') == 'pronto') {?>selected<?php }?>>Pronto</option>
                                <option value="annullato" <?php if ($_smarty_tpl->getValue('statoClasse') == 'annullato') {?>selected<?php }?>>Annullato</option>
                            </select>
                        </form>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Nessun ordine in cucina.</p>
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
