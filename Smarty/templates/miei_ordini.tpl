<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/miei_ordini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>

    <!-- Header -->
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>
        <section class="orders-section">
            <h1>I Miei Ordini</h1>

            {if $orders|@count > 0}
                {foreach from=$orders item=order}
                    <div class="order-card">
                        <div class="order-header">
                            <h2>Ordine #{$order->getId()}</h2>
                            <span class="order-date">
                                {if $order->getDataEsecuzione()}
                                    {$order->getDataEsecuzione()|date_format:"%d %B %Y"}
                                {else}
                                    Data non disponibile
                                {/if}
                            </span>
                        </div>
                        <div class="order-items">
                            <p>
                                <strong>Prodotti:</strong>
                                {foreach from=$order->getItemOrdini() item=itemOrdine name=itemLoop}
                                    {$itemOrdine->getProdotto()->getNome()}{if !$smarty.foreach.itemLoop.last}, {/if}
                                {/foreach}
                            </p>
                            <p><strong>Totale:</strong> €{$order->getCosto()}</p>
                            <p><strong>Note:</strong> {$order->getNote()|default:"-"}</p>
                            <p><strong>Stato:</strong> {$order->getStato()|capitalize}</p>
                        </div>
                    </div>
                {/foreach}
            {else}
                <p>Non hai ancora effettuato ordini.</p>
            {/if}

        </section>
    </main>


    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
</body>
</html>
