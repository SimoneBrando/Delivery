<?php
/* Smarty version 5.5.1, created on 2025-06-29 12:21:01
  from 'file:waiting_orders.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6861138d2cf386_05418663',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d0e4bcfe5a0c690469298830419db939b0820fe' => 
    array (
      0 => 'waiting_orders.tpl',
      1 => 1751190986,
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
function content_6861138d2cf386_05418663 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consegne - Nome Ristorante</title>
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
                            <p><strong>Data consegna prevista:</strong> <?php echo $_smarty_tpl->getValue('order')->getDataRicezione()->format('d/m/Y H:i:s');?>
</p>
                            <p><strong>Indirizzo :</strong> <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getVia();?>
 <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getCivico();?>
, <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getCitta();?>
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
                                    <li><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
 - qty: <?php echo $_smarty_tpl->getValue('itemOrdine')->getQuantita();?>
 - €<?php echo $_smarty_tpl->getValue('itemOrdine')->getPrezzoUnitarioAlMomento();?>
</li>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </ul>
                        </div>
                        <div class="delivery-actions">
                            <form action="/Delivery/Chef/accettaOrdine" method="POST" style="display:inline-block; margin-right: 10px;">
                                <input type="hidden" name="ordine_id" value="<?php echo $_smarty_tpl->getValue('order')->getId();?>
" />
                                <button type="submit" class="btn btn-success">Accetta</button>
                            </form>

                            <form action="/Delivery/Chef/rifiutaOrdine" method="POST" style="display:inline-block;">
                                <input type="hidden" name="ordine_id" value="<?php echo $_smarty_tpl->getValue('order')->getId();?>
" />
                                <button type="submit" class="btn btn-danger">Rifiuta</button>
                            </form>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Nessun ordine in attesa.</p>
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
 src="/Smarty/js/orders.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js" defer><?php echo '</script'; ?>
>

</body>

</html>
<?php }
}
