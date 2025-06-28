<?php
/* Smarty version 5.5.1, created on 2025-06-27 18:11:21
  from 'file:admin_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ec2a9e60760_92244058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28d10ed16d04c9887025d3bc3415bb95cc1cd855' => 
    array (
      0 => 'admin_order.tpl',
      1 => 1751039408,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685ec2a9e60760_92244058 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gestione Ordini | Home Restaurant</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/admin_orders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main class="admin-container">
        <div class="admin-header">
            <a href="/Delivery/Proprietario/showPanel" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1><i class="fas fa-shopping-bag"></i> Gestione Ordini</h1>
            <p class="admin-subtitle">Visualizza e gestisci tutti gli ordini dei clienti</p>
        </div>
        
        <!-- Filtri e Ricerca -->
        <form method="get" action="/Delivery/Proprietario/showOrders/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="<?php echo htmlspecialchars((string)(($tmp = $_GET['search'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Cerca ordini...">
                </div>
                <div class="filter-group">
                    <label for="filterStatus"><i class="fas fa-filter"></i> Filtra per stato:</label>
                    <select name="status" id="filterStatus">
                        <option value="all" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? 'all' ?? null : $tmp)) == 'all') {?>selected<?php }?>>Tutti gli stati</option>
                        <option value="in_attesa" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'in_attesa') {?>selected<?php }?>>In attesa</option>
                        <option value="in_preparazione" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'in_preparazione') {?>selected<?php }?>>In preparazione</option>
                        <option value="pronto" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'pronto') {?>selected<?php }?>>Pronto</option>
                        <option value="consegnato" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'consegnato') {?>selected<?php }?>>Consegnato</option>
                        <option value="annullato" <?php if (((($tmp = $_GET['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'annullato') {?>selected<?php }?>>Annullato</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filterDate"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select name="sort" id="filterDate">
                        <option value="newest" <?php if (((($tmp = $_GET['sort'] ?? null)===null||$tmp==='' ? 'newest' ?? null : $tmp)) == 'newest') {?>selected<?php }?>>Più recenti</option>
                        <option value="oldest" <?php if (((($tmp = $_GET['sort'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'oldest') {?>selected<?php }?>>Più vecchi</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-apply-filters">Applica filtri</button>
                </div>
            </div>
        </section>

        <!-- Lista Ordini -->
        <section class="orders-list">
            <div class="orders-header">
                <h2><i class="fas fa-list"></i> Tutti gli Ordini</h2>
            </div>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders')) > 0) {?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Totale</th>
                            <th>Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                            <tr data-id="<?php echo $_smarty_tpl->getValue('order')->getId();?>
">
                                <td>#<?php echo $_smarty_tpl->getValue('order')->getId();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('order')->getCliente()->getNome();?>
 <?php echo $_smarty_tpl->getValue('order')->getCliente()->getCognome();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('order')->getDataEsecuzione()->format('d/m/Y H:i');?>
</td>
                                <td>€<?php echo $_smarty_tpl->getValue('order')->getCosto();?>
</td>
                                <td>
                                    <span class="status-badge <?php echo $_smarty_tpl->getValue('order')->getStato();?>
">
                                        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->getStato());?>

                                    </span>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="no-orders">
                    <i class="far fa-frown"></i>
                    <p>Nessun ordine trovato</p>
                </div>
            <?php }?>
        </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/admin_orders.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
