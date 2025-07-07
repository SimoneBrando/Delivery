<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

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
                <p>€{$totaleOggi|number_format:2:",":"."}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-info">
                <h3>Ordini Oggi</h3>
                <p>{$ordiniOggi}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Nuovi Clienti Totali</h3>
                <p>{$numeroClienti}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>Valutazione Media</h3>
                <p>{$mediaValutazioni|round:1}/5</p>
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
                    {foreach from=$ordini item=ordine}
                        <tr>
                            <td data-label="ID">#{$ordine->getId()}</td>
                            <td data-label="Cliente">{$ordine->getCliente()->getNome()} {$ordine->getCliente()->getCognome()}</td>
                            <td data-label="Importo">€{$ordine->getCosto()|number_format:2}</td>
                            <td data-label="Stato">
                                <span class="status {$ordine->getStato()|lower}">
                                    {$ordine->getStato()|capitalize}
                                </span>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </section>

    <!-- Footer -->
    
    {include file="footer.tpl"}

    <!-- Script per i grafici -->
    <script>
        // grafico fatturato
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'],
                datasets: [{
                    label: 'Fatturato (€)',
                    data: {$fatturatoSettimana|@json_encode},
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
                labels: {$nomiPiatti|@json_encode},
                datasets: [{
                    data: {$quantitaPiatti|@json_encode},
                    backgroundColor: ['#046C6D',  '#035050',  '#03A6A6',  '#04B2B2',  '#05C0C0',  '#057878',  '#028484',  '#039393',  '#026969', '#064B4B']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script src="/Smarty/Js/hamburger.js"></script>
    <script src="/Smarty/Js/theme.js" defer></script>

</body>
</html>
