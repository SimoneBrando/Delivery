<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/miei_ordini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>

    <!-- Header -->
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>
        <section class="cart-section">
            <div class="cart-container">
                <div class="order-card">
                    <div class="order-header">
                        <h2>Riepilogo ordine</h2>
                        <span class="order-date" id="order-date">--</span>
                    </div>
                    <div class="order-items">
                        <strong>Prodotti:</strong>
                        <ul id="cart-items">
                            <!-- JS inserirà qui i prodotti -->
                        </ul>
                        <p class="total-amount"><strong>Totale:</strong> €<span id="total-amount">0.00</span></p>
                    </div>
                    <!-- Form nascosto per l'invio dei dati -->
                    <form id="cartForm" method="POST" action="/Delivery/Ordine/confirmPayment">
                        <input type="hidden" name="cart_data" id="cartDataInput">
                        <input type="hidden" name="created_at" id="createdAtInput">
                        <div>
                            <labe for="note">Inserisci Note</label>
                            <input type="text" name="note" id="note" value="">
                        </div>
                    </form>
                <button onclick="submitCart()" id="checkout-button" class="checkout-button">Procedi al pagamento</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
    <script src="/Smarty/Js/cart.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            confirmOrder();
            const cart = JSON.parse(localStorage.getItem("cart") || "[]");
            const checkoutBtn = document.getElementById("checkout-button");

            const total = cart.reduce((sum, item) => sum + item.qty * item.price, 0);

            if (total === 0 || cart.length === 0) {
                checkoutBtn.disabled = true;
                checkoutBtn.classList.add("disabled");
                checkoutBtn.textContent = "Carrello vuoto";
            } else {
                checkoutBtn.disabled = false;
            }
        });
    </script>
</body>
</html>