<?php
/* Smarty version 5.5.1, created on 2025-07-07 14:58:33
  from 'file:order_card.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686bc479dc9653_39355619',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3dc1aaf8b6237f6395f674290642793b7a6e483' => 
    array (
      0 => 'order_card.tpl',
      1 => 1751893111,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686bc479dc9653_39355619 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><div class="delivery-card">
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
        <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'in_consegna') {?>
            <?php $_smarty_tpl->assign('statoClasse', 'in_consegna', false, NULL);?>
        <?php }?>

        <span class="order-status <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('statoClasse'), ENT_QUOTES, 'UTF-8', true);?>
">
            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('order')->getStato(),"_"," "));?>

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
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('itemOrdine')->value) {
$foreach0DoElse = false;
?>
                <li><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 - 
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('itemOrdine')->getProdotto()->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
 - 
                    qty: <?php echo $_smarty_tpl->getValue('itemOrdine')->getQuantita();?>
 - 
                    €<?php echo $_smarty_tpl->getValue('itemOrdine')->getPrezzoUnitarioAlMomento();?>

                </li>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </ul>
    </div>

    <form method="POST" action="/Delivery/Rider/cambiaStatoOrdine" class="status-form">
        <input type="hidden" name="ordineId" value="<?php echo $_smarty_tpl->getValue('order')->getId();?>
">
        <label for="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
">Modifica stato:</label>
        <select name="stato" id="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
" class="status-select">
            <option value="">-- Seleziona stato --</option>
            <?php if ($_smarty_tpl->getValue('statoClasse') == 'pronto') {?>
                <option value="pronto" selected>Pronto</option>
            <?php }?>
            <option value="in_consegna" <?php if ($_smarty_tpl->getValue('statoClasse') == 'in_consegna') {?>selected<?php }?>>In Consegna</option>
            <option value="consegnato" <?php if ($_smarty_tpl->getValue('statoClasse') == 'consegnato') {?>selected<?php }?>>Consegnato</option>

            <?php if ($_smarty_tpl->getValue('showExtraStatuses')) {?>
                <option value="in_preparazione" <?php if ($_smarty_tpl->getValue('statoClasse') == 'in_preparazione') {?>selected<?php }?>>In Preparazione</option>
                <option value="in_attesa" <?php if ($_smarty_tpl->getValue('statoClasse') == 'errore') {?>selected<?php }?>>In Attesa</option>
            <?php }?>
        </select>
    </form>
</div>
<?php }
}
