<?php
/* Smarty version 5.5.1, created on 2025-07-02 15:49:12
  from 'file:miei_ordini.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686538d8ba6ba3_65335622',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c097591f2f6c1944940b106e904d446dd03a6ded' => 
    array (
      0 => 'miei_ordini.tpl',
      1 => 1751368391,
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
function content_686538d8ba6ba3_65335622 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/miei_ordini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>

    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main>

        <!-- Orders Section -->
        <section class="orders-section">

            <!-- Error Section -->
            <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            
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
                            <h2>Ordine del <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('order')->getDataRicezione(),"%d/%m/%y");?>
</h2>
                            <span class="order-date">
                                <?php if ($_smarty_tpl->getValue('order')->getDataEsecuzione()) {?>
                                    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('order')->getDataEsecuzione(),"%d/%m/%y");?>

                                <?php } else { ?>
                                    Data non disponibile
                                <?php }?>
                            </span>
                        </div>
                        <div class="order-items">
                            <p>
                                <strong>Prodotti:</strong>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->getItemOrdini(), 'itemOrdine', false, NULL, 'itemLoop', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('itemOrdine')->value) {
$foreach1DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_itemLoop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_itemLoop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_itemLoop']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_itemLoop']->value['total'];
?>
                                    <?php echo $_smarty_tpl->getValue('itemOrdine')->getProdotto()->getNome();
if (!($_smarty_tpl->getValue('__smarty_foreach_itemLoop')['last'] ?? null)) {?>,  <?php }?>
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
                            <p><strong>Indirizzo:</strong> <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getCitta();?>
, <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getVia();?>
, <?php echo $_smarty_tpl->getValue('order')->getIndirizzoConsegna()->getCivico();?>
</p>
                            <p><strong>Metodo Pagamento:</strong> <?php echo $_smarty_tpl->getValue('order')->getMetodoPagamento()->getNominativo();?>
</p>
                        </div>
                        <div class="order-problems">
                            <button type="button" data-modal-target="reportModal" class="btn-link-modal" data-order-id="<?php echo $_smarty_tpl->getValue('order')->getId();?>
">
                                <i class="fas fa-exclamation-triangle"></i> Segnala problema
                            </button>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <p>Non hai ancora effettuato ordini.</p>
            <?php }?>

        </section>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders')) > 0) {?>
            <div class="review-conteiner">
                <a href="/Delivery/User/showReviewForm/" class="btn">Scrivi recensione!</a>
            </div>
        <?php }?>
    </main>


    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Modal Aggiungi Segnalazione -->
        <div id="reportModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>

                <h2>Crea segnalazione <span id="modal-order-id"></span></h2>

                <form method="POST" action="/Delivery/Segnalazione/writeReport" class="form">

                        <div class="form-group">
                            <label for="descrizione">Descrizione</label>
                            <input type="text" id="descrizione" name="descrizione" required>
                        </div>

                        <div class="form-group">
                            <label for="testo">Testo</label>
                            <input type="text" id="testo" name="testo" required>
                        </div>

                        <input type="hidden" id="ordine_id" name="ordine_id" required>

                        <button type="submit">Invia Segnalazione</button>

                </form>
            </div>
        </div>

    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js" defer><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/report_modal.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
