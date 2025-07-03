<?php
/* Smarty version 5.5.1, created on 2025-07-03 18:09:13
  from 'file:admin_panel.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6866ab293e04c0_14087141',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '624e5bbb3f25a3d609755223230f47628ffb82bb' => 
    array (
      0 => 'admin_panel.tpl',
      1 => 1751558513,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6866ab293e04c0_14087141 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main class="admin-preview-container">
        <h1><i class="fas fa-user-shield"></i> Pannello di Amministrazione</h1>
        <p class="admin-subtitle">Gestisci il tuo ristorante da questa area riservata</p>
        
        <!-- Sezioni di Accesso Rapido -->
        <section class="admin-sections-grid">
            <a href="/Delivery/Proprietario/showDashboard" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-tachometer-alt"></i></div>
                <div class="section-content">
                    <h2>Dashboard</h2>
                    <p>Statistiche e panoramica dell'attività</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showMenu" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-utensils"></i></div>
                <div class="section-content">
                    <h2>Gestione Menu</h2>
                    <p>Aggiungi, modifica o elimina piatti dal menu</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showOrders" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-shopping-bag"></i></div>
                <div class="section-content">
                    <h2>Gestione Ordini</h2>
                    <p>Visualizza e gestisci gli ordini dei clienti</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showCalendar" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="section-content">
                    <h2>Gestione Calendario</h2>
                    <p>Gestisci i giorni di apertura e chiusura</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showReviews" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-star"></i></div>
                <div class="section-content">
                    <h2>Recensioni</h2>
                    <p>Leggi le recensioni dei clienti</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showSegnalazioni" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="section-content">
                    <h2>Segnalazioni</h2>
                    <p>Leggi le segnalazioni degli ordini</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            <a href="/Delivery/Proprietario/showCreateAccount" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-cog"></i></div>
                <div class="section-content">
                    <h2>Gestione account</h2>
                    <p>Configura gli account del tuo ristorante</p>
                </div>
                <div class="section-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
        </section>

        <!-- Statistiche Rapide -->
        <section class="quick-stats">
            <h2><i class="fas fa-chart-pie"></i> Panoramica Rapida</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-euro-sign"></i></div>
                    <div class="stat-info">
                        <h3>Fatturato della Settimana</h3>
                        <p>€<?php echo $_smarty_tpl->getValue('totaleSettimana');?>
</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="stat-info">
                        <h3>Ordini della Settimana</h3>
                        <p><?php echo $_smarty_tpl->getValue('ordiniSettimana');?>
</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Clienti totali</h3>
                        <p><?php echo $_smarty_tpl->getValue('numeroClienti');?>
</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ultimi Ordini Dinamici -->
        <section class="recent-orders">
            <h2><i class="fas fa-history"></i> Ultimi Ordini</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Importo</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'ordine');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ordine')->value) {
$foreach0DoElse = false;
?>
                        <tr>
                            <td data-label="ID">#<?php echo $_smarty_tpl->getValue('ordine')->getId();?>
</td>
                            <td data-label="Cliente"><?php echo $_smarty_tpl->getValue('ordine')->getCliente()->getNome();?>
 <?php echo $_smarty_tpl->getValue('ordine')->getCliente()->getCognome();?>
</td>
                            <td data-label="Importo">€<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('ordine')->getCosto(),2);?>
</td>
                            <td data-label="Stato">
                                <span class="status <?php echo mb_strtolower((string) $_smarty_tpl->getValue('ordine')->getStato(), 'UTF-8');?>
">
                                    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('ordine')->getStato());?>

                                </span>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
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
</body>
</html>
<?php }
}
