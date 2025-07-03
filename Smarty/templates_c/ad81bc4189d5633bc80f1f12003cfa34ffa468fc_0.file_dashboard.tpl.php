<?php
/* Smarty version 5.5.1, created on 2025-07-03 18:09:11
  from 'file:dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6866ab27277356_85575663',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad81bc4189d5633bc80f1f12003cfa34ffa468fc' => 
    array (
      0 => 'dashboard.tpl',
      1 => 1751368391,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6866ab27277356_85575663 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <div class="dashboard-header">
        <a href="/Delivery/Proprietario/showPanel" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    </div>

    <!-- Statistiche Rapide -->
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <div class="stat-info">
                <h3>Fatturato Oggi</h3>
                <p>€<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('totaleOggi'),2,",",".");?>
</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-info">
                <h3>Ordini Oggi</h3>
                <p><?php echo $_smarty_tpl->getValue('ordiniOggi');?>
</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Nuovi Clienti Totali</h3>
                <p><?php echo $_smarty_tpl->getValue('numeroClienti');?>
</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>Valutazione Media</h3>
                <p><?php echo round((float) $_smarty_tpl->getValue('mediaValutazioni'), (int) 1, (int) 1);?>
/5</p>
            </div>
        </div>
    </section>

    <!-- Grafici -->
    <section class="charts-section">
        <div class="chart-container">
            <h2><i class="fas fa-chart-line"></i> Fatturato Ultimi 7 Giorni</h2>
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="chart-container">
            <h2><i class="fas fa-pizza-slice"></i> Piatti Più Venduti</h2>
            <canvas id="dishesChart"></canvas>
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
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ordini'), 'ordine');
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

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Script per i grafici -->
    <?php echo '<script'; ?>
>
        // grafico fatturato
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'],
                datasets: [{
                    label: 'Fatturato (€)',
                    data: <?php echo json_encode($_smarty_tpl->getValue('fatturatoSettimana'));?>
,
                    backgroundColor: '#046C6D',
                    borderColor: '#035050',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // grafico piatti più venduti
        const dishesCtx = document.getElementById('dishesChart').getContext('2d');
        new Chart(dishesCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($_smarty_tpl->getValue('nomiPiatti'));?>
,
                datasets: [{
                    data: <?php echo json_encode($_smarty_tpl->getValue('quantitaPiatti'));?>
,
                    backgroundColor: ['#046C6D',  '#035050',  '#03A6A6',  '#04B2B2',  '#05C0C0',  '#057878',  '#028484',  '#039393',  '#026969', '#064B4B']
                }]
            },
            options: {
                responsive: true
            }
        });
    <?php echo '</script'; ?>
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
