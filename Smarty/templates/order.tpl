<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/order.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="/Smarty/css/layout.css" />
</head>
<body>
    {include file="header.tpl"}

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="menu-section">
            <div id="menu-container"></div>
            
            <h1>Ordina dal menù</h1>

            {foreach $menu as $categoria}
                <div class="menu-category">
                    <h2>
                        {if $categoria.categoria == "Antipasti"}<i class="fa-solid fa-martini-glass-citrus"></i>{/if}
                        {if $categoria.categoria == "Primi"}<i class="fas fa-bread-slice"></i>{/if}
                        {if $categoria.categoria == "Secondi"}<i class="fas fa-pizza-slice"></i>{/if}
                        {if $categoria.categoria == "Dolci"}<i class="fa-solid fa-ice-cream"></i>{/if}
                        {if $categoria.categoria == "Bevande"}<i class="fas fa-glass-whiskey"></i>{/if}
                        {$categoria.categoria|escape}
                    </h2>
                    <div class="menu-items">
                        {foreach $categoria.piatti as $piatto}
                            <div class="menu-item">
                                <div class="item-info">
                                    <h3>{$piatto.nome|escape}</h3>
                                    <p>{$piatto.descrizione|escape}</p>
                                </div>
                                <div class="item-price">€{$piatto.costo|escape}</div>
                                <button class="add-button" data-id="{$piatto.id}">+</button>
                            </div>
                        {/foreach}
                    </div>
                </div>
            {/foreach}
        </section>
    </main>

    <div id="cart-icon" class="cart-icon hidden">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-badge">0</span>
    </div>

    <div id="cart" class="cart">
        <h2>Il tuo ordine</h2>
        <ul id="cart-items"></ul>
        <p id="cart-total">Totale: €0.00</p>
        <form id="cartForm" method="POST" action="/Delivery/Ordine/showConfirmOrder">
            <input type="hidden" name="cart_data" id="cartDataInput">
            <button type="submit">Prosegui Ordine</button>
        </form>
    </div>

    <div id="product-modal" class="modal hidden">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>

    {include file="footer.tpl"}


    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>

</body>

<script src="/Smarty/Js/cart.js" defer></script>
<script src="/Smarty/js/menu.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        cart = localStorage.getItem("cart") ? JSON.parse(localStorage.getItem("cart")) : [];
        cartForm.addEventListener("submit", function(event) {
            const currentCart = localStorage.getItem("cart");
            document.getElementById("cartDataInput").value = currentCart;
        });
        renderCart();
        showCartIcon();
    });
</script>
</html>
