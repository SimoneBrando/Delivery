<!DOCTYPE html>
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
    {include file="header.tpl"}

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
        
            <!-- Error Section -->
            {include file="error_section.tpl"}

        <form method="get" action="/Delivery/Proprietario/showOrders/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{$smarty.get.search|default:''|escape}" placeholder="Cerca ordini...">
                </div>
                <div class="filter-group">
                    <label for="filterStatus"><i class="fas fa-filter"></i> Filtra per stato:</label>
                    <select name="status" id="filterStatus">
                        <option value="all" {if ($smarty.get.status|default:'all') == 'all'}selected{/if}>Tutti gli stati</option>
                        <option value="in_attesa" {if ($smarty.get.status|default:'') == 'in_attesa'}selected{/if}>In attesa</option>
                        <option value="in_preparazione" {if ($smarty.get.status|default:'') == 'in_preparazione'}selected{/if}>In preparazione</option>
                        <option value="pronto" {if ($smarty.get.status|default:'') == 'pronto'}selected{/if}>Pronto</option>
                        <option value="consegnato" {if ($smarty.get.status|default:'') == 'consegnato'}selected{/if}>Consegnato</option>
                        <option value="annullato" {if ($smarty.get.status|default:'') == 'annullato'}selected{/if}>Annullato</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filterDate"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select name="sort" id="filterDate">
                        <option value="newest" {if ($smarty.get.sort|default:'newest') == 'newest'}selected{/if}>Più recenti</option>
                        <option value="oldest" {if ($smarty.get.sort|default:'') == 'oldest'}selected{/if}>Più vecchi</option>
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
            
            {if $orders|@count > 0}
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
                        {foreach from=$orders item=order}
                            <tr data-id="{$order->getId()}">
                                <td>#{$order->getId()}</td>
                                <td>{$order->getCliente()->getNome()} {$order->getCliente()->getCognome()}</td>
                                <td>{$order->getDataEsecuzione()->format('d/m/Y H:i')}</td>
                                <td>€{$order->getCosto()}</td>
                                <td>
                                    <span class="status-badge {$order->getStato()}">
                                        {$order->getStato()|capitalize}
                                    </span>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else}
                <div class="no-orders">
                    <i class="far fa-frown"></i>
                    <p>Nessun ordine trovato</p>
                </div>
            {/if}
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js"></script>
    <script src="/Smarty/js/admin_orders.js"></script>
</body>
</html>