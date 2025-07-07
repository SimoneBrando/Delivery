<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Recensioni | Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/recensioni.css">
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
            <h1><i class="fas fa-star"></i> Gestione Segnalazioni</h1>
            <p class="admin-subtitle">Visualizza tutte le segnalazioni dei clienti</p>
        </div>
        
        <!-- Filtri e Ricerca -->

            <!-- Error Section -->
            {include file="error_section.tpl"}
        
        <form method="get" action="/Delivery/Proprietario/showSegnalazioni/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{$smarty.get.search|default:''|escape}" placeholder="Cerca recensioni...">
                </div>
                <div class="filter-group">
                    <label for="sort"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select name="sort" id="sort">
                        <option value="newest" {if ($smarty.get.sort|default:'newest') == 'newest' || !$smarty.get.sort}selected{/if}>Più recenti</option>
                        <option value="oldest" {if ($smarty.get.sort|default:'') == 'oldest'}selected{/if}>Più vecchie</option>
                    </select>
                </div>
                <div class="filter-group">
                <button type="submit" class="btn-apply-filters">Applica filtri</button>
            </div>
            </div>
        </section><br>

        <!-- Lista Segnalazioni -->
        <section class="reviews-list">
            <div class="reviews-header">
                <h2><i class="fas fa-list"></i> Tutte le Segnalazioni</h2>
            </div>
            
            {if $segnalazioni|@count > 0}
                <div class="reviews-grid">
                    {foreach from=$segnalazioni item=segnalazione}
                        <div class="review-card">
                            <div class="review-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="user-details">
                                        <h3>{$segnalazione->getOrdine()->getCliente()->getNome()} {$segnalazione->getOrdine()->getCliente()->getCognome()} </h3>
                                        <p>Id Ordine: {$segnalazione->getOrdine()->getId()} </p>
                                        <span class="review-date">{$segnalazione->getData()|date_format:"%H:%M %e %B %Y"}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>{$segnalazione->getDescrizione()}</p>
                            </div>
                        </div>
                    {/foreach}
                </div>
            {else}
                <div class="no-reviews">
                    <i class="far fa-frown"></i>
                    <p>Nessuna segnalazione trovata</p>
                </div>
            {/if}
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}


    <script src="/Smarty/Js/hamburger.js"></script>
    <script src="/Smarty/Js/theme.js" defer></script>
</body>
</html>