<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Miei Ordini - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/miei_ordini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/layout.css"></link>
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>

    <!-- Header -->
    <div id="header-placeholder"></div>

    <!-- Main Content -->
    <main>
        <section class="orders-section">
            <h1>I Miei Ordini</h1>

            {* Cicla su tutti gli ordini e crea la card *}
            {foreach from=$orders item=order}
                <div class="order-card">
                    <div class="order-header">
                        <h2>Ordine #{$order.id|escape}</h2>
                        <span class="order-date">{$order.date|escape}</span>
                    </div>
                    <div class="order-items">
                        <p><strong>Prodotti:</strong> {$order.products|escape}</p>
                        <p><strong>Totale:</strong> {$order.total|escape}</p>
                        <p><strong>Pagamento:</strong> {$order.payment|escape}</p>
                        <p><strong>Consegna a:</strong> {$order.address|escape}</p>
                    </div>
                </div>
            {/foreach}

            {* Se non ci sono ordini, mostra un messaggio *}
            {if $orders|@count == 0}
                <p>Non hai ancora effettuato ordini.</p>
            {/if}

        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>

</body>
</html>
