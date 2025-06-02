<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/layout.css"></link>
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>
    <!-- Header -->
    
    <div id="header-placeholder"></div>

    <!-- Main Content -->
    <main>
        
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="menu-section">
        <h1>Ordina dal menù</h1>
        
        {* Cicla sulle categorie del menù *}
        {foreach from=$menu item=category}
            <div class="menu-category">
                <h2>
                    {* Se vuoi l’icona *}
                    <i class="{$category.icon|escape}"></i> 
                    {$category.category|escape}
                </h2>
                <div class="menu-items">
                    
                    {* Cicla sui piatti *}
                    {foreach from=$category.items item=item}
                        <div class="menu-item">
                            <div class="item-info">
                                <h3>{$item.name|escape}</h3>
                                <p>{$item.description|escape}</p>
                            </div>
                            <div class="item-price">{$item.price|escape}</div>
                            <button class="add-button">+</button>
                        </div>
                    {/foreach}
                    
                </div>
            </div>
        {/foreach}
    </section>

    </main>

     <!-- Carrello Virtuale -->
    <div id="cart-icon" class="cart-icon hidden">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-badge">0</span>
    </div>

    <div id="cart" class="cart">
        <h2>Il tuo ordine</h2>
        <ul id="cart-items"></ul>
        <p id="cart-total">Totale: €0.00</p>
        <a href="checkout.html">
            <button>Prosegui</button>
        </a>
    </div>

    <!-- Modale Dettaglio Prodotto -->
    <div id="product-modal" class="modal hidden">
        <div class="modal-content">
            <span class="close-button">&times;</span>
                <div id="modal-body">
                <!-- I dettagli del prodotto saranno caricati qui -->
                </div>
        </div>
    </div>




    <!-- Footer -->
    
    <div id="footer-placeholder"></div>

</body>

<script src="../Js/cart.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
        renderCart();
        showCartIcon();
    });
</script>

</html>