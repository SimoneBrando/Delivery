<?php
/* Smarty version 5.5.1, created on 2025-06-16 13:08:41
  from 'file:admin_order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684ffb39c36a63_09794617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da8473b92e7b12688303a1c22652f7a4dc8d396b' => 
    array (
      0 => 'admin_order.tpl',
      1 => 1750072120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684ffb39c36a63_09794617 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
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
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchOrders" placeholder="Cerca ordini...">
                </div>
                <div class="filter-group">
                    <label for="filterStatus"><i class="fas fa-filter"></i> Filtra per stato:</label>
                    <select id="filterStatus">
                        <option value="all">Tutti gli stati</option>
                        <option value="in_attesa">In attesa</option>
                        <option value="in_preparazione">In preparazione</option>
                        <option value="pronto">Pronto</option>
                        <option value="consegnato">Consegnato</option>
                        <option value="annullato">Annullato</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filterDate"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select id="filterDate">
                        <option value="newest">Più recenti</option>
                        <option value="oldest">Più vecchi</option>
                    </select>
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
