<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consegne - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/personale_consegne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <script src="/Smarty/Js/loadComponents.js" defer></script>
</head>
<body>
    <div id="header-placeholder"></div>

    <main>
        <div class="deliveries-container">
            {foreach $orders as $order}
                <div class="delivery-card">
                    <div class="delivery-header">
                        <h3>Ordine #{$order.id}</h3>
                        {assign var=statoClasse value=''}
                        {if $order.stato == 'in_attesa'}
                            {assign var=statoClasse value='da-ritirare'}
                        {elseif $order.stato == 'in_preparazione'}
                            {assign var=statoClasse value='in-consegna'}
                        {elseif $order.stato == 'pronto'}
                            {assign var=statoClasse value='in-consegna'}
                        {elseif $order.stato == 'consegnato'}
                            {assign var=statoClasse value='consegnato'}
                        {elseif $order.stato == 'annullato'}
                            {assign var=statoClasse value='errore'}
                        {/if}
                        <span class="order-status {$statoClasse|escape}">{$order.stato|replace:"_":" "|capitalize}</span>
                    </div>
                    <div class="delivery-info">
                        <p><strong>Note:</strong> {$order.note|escape}</p>
                        <p><strong>Data esecuzione:</strong> {$order.dataEsecuzione}</p>
                        <p><strong>Data ricezione:</strong> {$order.dataRicezione}</p>
                        <p><strong>Costo totale:</strong> €{$order.costo}</p>
                        <p><strong>Prodotti:</strong></p>
                        <ul>
                            {foreach $order.prodotti as $prodotto}
                                <li>{$prodotto.nome|escape} - {$prodotto.descrizione|escape} - €{$prodotto.costo}</li>
                            {/foreach}
                        </ul>
                    </div>
                    <div class="status-actions">
                        <label for="status{$order.id}">Modifica stato:</label>
                        <select id="status{$order.id}" class="status-select">
                            <option value="da-ritirare" {if $statoClasse == 'da-ritirare'}selected{/if}>Da ritirare</option>
                            <option value="in-consegna" {if $statoClasse == 'in-consegna'}selected{/if}>In consegna</option>
                            <option value="consegnato" {if $statoClasse == 'consegnato'}selected{/if}>Consegnato</option>
                            <option value="errore" {if $statoClasse == 'errore'}selected{/if}>Errore</option>
                        </select>
                    </div>
                </div>
            {/foreach}
        </div>
    </main>

    <div id="footer-placeholder"></div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelects = document.querySelectorAll('.status-select');
        statusSelects.forEach(select => {
            select.addEventListener('change', function() {
                const statusElement = this.closest('.delivery-card').querySelector('.order-status');
                const newStatus = this.value;
                statusElement.textContent = this.options[this.selectedIndex].text;

                statusElement.classList.remove('in-consegna', 'consegnato', 'errore', 'da-ritirare');

                switch(newStatus) {
                    case 'in-consegna':
                        statusElement.classList.add('in-consegna');
                        break;
                    case 'consegnato':
                        statusElement.classList.add('consegnato');
                        break;
                    case 'errore':
                        statusElement.classList.add('errore');
                        break;
                    case 'da-ritirare':
                        statusElement.classList.add('da-ritirare');
                        break;
                }
            });
        });
    });
</script>

</html>
