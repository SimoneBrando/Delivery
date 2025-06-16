<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Home Restaurant</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

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
            <a href="/Delivery/Proprietario/showReviews" class="admin-section-card">
                <div class="section-icon"><i class="fas fa-star"></i></div>
                <div class="section-content">
                    <h2>Recensioni</h2>
                    <p>Leggi le recensioni dei clienti</p>
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
                        <p>€{$totaleSettimana}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="stat-info">
                        <h3>Ordini della Settimana</h3>
                        <p>{$ordiniSettimana}</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Clienti totali</h3>
                        <p>{$numeroClienti}</p>
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
                    {foreach from=$orders item=ordine}
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
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}


    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
</body>
</html>
