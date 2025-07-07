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
            <h1><i class="fas fa-star"></i> Gestione Recensioni</h1>
            <p class="admin-subtitle">Visualizza e gestisci tutte le recensioni dei clienti</p>
        </div>
        
        <!-- Filtri e Ricerca -->

            <!-- Error Section -->
            {include file="error_section.tpl"}
        
        <form method="get" action="/Delivery/Proprietario/showReviews/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{$smarty.get.search|default:''|escape}" placeholder="Cerca recensioni...">
                </div>
                <div class="filter-group">
                    <label for="stars"><i class="fas fa-filter"></i> Filtra per voto:</label>
                    <select name="stars" id="stars">
                        <option value="all" {if ($smarty.get.stars|default:'all') == 'all' || !$smarty.get.stars}selected{/if}>Tutti i voti</option>
                        <option value="5" {if ($smarty.get.stars|default:'') == '5'}selected{/if}>5 stelle</option>
                        <option value="4" {if ($smarty.get.stars|default:'') == '4'}selected{/if}>4 stelle</option>
                        <option value="3" {if ($smarty.get.stars|default:'') == '3'}selected{/if}>3 stelle</option>
                        <option value="2" {if ($smarty.get.stars|default:'') == '2'}selected{/if}>2 stelle</option>
                        <option value="1" {if ($smarty.get.stars|default:'') == '1'}selected{/if}>1 stelle</option>
                    </select>
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

        <!-- Lista Recensioni -->
        <section class="reviews-list">
            <div class="reviews-header">
                <h2><i class="fas fa-list"></i> Tutte le Recensioni</h2>
            </div>
            
            {if $reviews|@count > 0}
                <div class="reviews-grid">
                    {foreach from=$reviews item=review}
                        <div class="review-card">
                            <div class="review-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="user-details">
                                        <h3>{$review->getCliente()->getNome()} {$review->getCliente()->getCognome()} </h3>
                                        <span class="review-date">{$review->getData()|date_format:"%H:%M %e %B %Y"}</span>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    {for $i=1 to 5}
                                        {if $i <= $review->getVoto()}
                                            <i class="fas fa-star filled"></i>
                                        {else}
                                            <i class="far fa-star"></i>
                                        {/if}
                                    {/for}
                                </div>
                            </div>
                            <div class="review-content">
                                <p>{$review->getDescrizione()}</p>
                            </div>
                        </div>
                    {/foreach}
                </div>
            {else}
                <div class="no-reviews">
                    <i class="far fa-frown"></i>
                    <p>Nessuna recensione trovata</p>
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