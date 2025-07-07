<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consegne - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/personale_consegne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
</head>
<body>
    {include file="header.tpl"}

    <main>

        
        <!-- Error Section -->
        {include file="error_section.tpl"}
        <div class="deliveries-container">
            <h2>Ordini Pronti</h2>
            {foreach $orders as $order}
                {include file="order_card.tpl" order=$order showExtraStatuses=false}
            {/foreach}
        </div>

        <div class="deliveries-container">
            <h2>Ordini In Consegna</h2>
            {foreach $ordersOnDelivery as $order}
                {include file="order_card.tpl" order=$order showExtraStatuses=true}
            {/foreach}
        </div>

        <div class="deliveries-container">
            <h2>I miei ordini</h2>
            {if $myOrders|@count > 0}
                {foreach $myOrders as $order}
                    {include file="order_card.tpl" order=$order showExtraStatuses=false}
                {/foreach}
            {else}
                <p>Non hai ordini assegnati al momento.</p>
            {/if}
        </div>

    </main>

    {include file="footer.tpl"}

    {* Modale per conferma *}
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>Sei sicuro di voler aggiornare lo stato in <strong><span id="modalStatus"></span></strong>?</p>
            <button id="confirmBtn">Conferma</button>
            <button onclick="closeModal()">Annulla</button>
        </div>
    </div>

    <script src="/Smarty/Js/orders.js"></script>
    <script src="/Smarty/Js/hamburger.js"></script>
    <script src="/Smarty/Js/theme.js" defer></script>
</body>


</html>
