<?php
/* Smarty version 5.5.1, created on 2025-06-13 12:01:41
  from 'file:chef_orders.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684bf7059106b5_47599477',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'decb6ce08fb6c6ed0387514e5b3b2ce9ea585252' => 
    array (
      0 => 'chef_orders.tpl',
      1 => 1749808897,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684bf7059106b5_47599477 (\Smarty\Template $_smarty_tpl) {
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
    <?php echo '<script'; ?>
 src="/Smarty/Js/loadComponents.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <div id="header-placeholder"></div>

    <main>
        <div class="deliveries-container">
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
                        <?php if ($_smarty_tpl->getValue('order')->getStato() == 'in_attesa') {?>
                            <?php $_smarty_tpl->assign('statoClasse', 'da-ritirare', false, NULL);?>
                        <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'in_preparazione') {?>
                            <?php $_smarty_tpl->assign('statoClasse', 'in-consegna', false, NULL);?>
                        <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'pronto') {?>
                            <?php $_smarty_tpl->assign('statoClasse', 'in-consegna', false, NULL);?>
                        <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'consegnato') {?>
                            <?php $_smarty_tpl->assign('statoClasse', 'consegnato', false, NULL);?>
                        <?php } elseif ($_smarty_tpl->getValue('order')->getStato() == 'annullato') {?>
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
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->getProdotti(), 'prodotto');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('prodotto')->value) {
$foreach1DoElse = false;
?>
                                <li><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('prodotto')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('prodotto')->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
 - €<?php echo $_smarty_tpl->getValue('prodotto')->getCosto();?>
</li>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>
                    <div class="status-actions">
                        <form method="post" action="/Delivery/Chef/cambiaStatoOrdine">
                            <input type="hidden" name="ordineId" value="<?php echo $_smarty_tpl->getValue('order')->getId();?>
">
                            <label for="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
">Modifica stato:</label>
                            <select id="status<?php echo $_smarty_tpl->getValue('order')->getId();?>
" name="stato" class="status-select">
                                <option value="da-ritirare" <?php if ($_smarty_tpl->getValue('statoClasse') == 'da-ritirare') {?>selected<?php }?>>Da ritirare</option>
                                <option value="in-consegna" <?php if ($_smarty_tpl->getValue('statoClasse') == 'in-consegna') {?>selected<?php }?>>In consegna</option>
                                <option value="consegnato" <?php if ($_smarty_tpl->getValue('statoClasse') == 'consegnato') {?>selected<?php }?>>Consegnato</option>
                                <option value="errore" <?php if ($_smarty_tpl->getValue('statoClasse') == 'errore') {?>selected<?php }?>>Errore</option>
                            </select>
                            <button type="submit">Conferma</button>
                        </form>
                    </div>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    </main>

    <div id="footer-placeholder"></div>

</body>

<?php echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelects = document.querySelectorAll('.status-select');
        statusSelects.forEach(select => {
            select.addEventListener('change', function() {
                const statusElement = this.closest('.delivery-card').querySelector('.order-status');
                const newStatus = this.value;
                statusElement.textContent = this.options[this.selectedIndex].text;

                statusElement.classList.remove('in-consegna', 'consegnato', 'errore', 'da-ritirare');

                switch(newStatus) {
                    case 'in-consegna':
                        statusElement.classList.add('in-consegna');
                        break;
                    case 'consegnato':
                        statusElement.classList.add('consegnato');
                        break;
                    case 'errore':
                        statusElement.classList.add('errore');
                        break;
                    case 'da-ritirare':
                        statusElement.classList.add('da-ritirare');
                        break;
                }
            });
        });
    });
<?php echo '</script'; ?>
>

</html>
<?php }
}
