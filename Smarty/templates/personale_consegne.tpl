<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consegne - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/personale_consegne.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/layout.css"></link>
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>
    <!-- Header -->
    <div id="header-placeholder"></div>
        
    <!-- Consegne section -->
    <main>
        <div class="deliveries-container">
            {foreach from=$deliveries item=delivery name=dl}
                <div class="delivery-card">
                    <div class="delivery-header">
                        <h3>Ordine #{$delivery.id|escape}</h3>
                        <span class="order-status {if $delivery.status == 'in-consegna'}in-consegna
                                                 {elseif $delivery.status == 'consegnato'}consegnato
                                                 {elseif $delivery.status == 'errore'}errore
                                                 {elseif $delivery.status == 'da-ritirare'}da-ritirare
                                                 {/if}">
                            {$delivery.status_label|escape}
                        </span>
                    </div>
                    <div class="delivery-info">
                        <p><strong>Posizione:</strong> {$delivery.position|escape}</p>
                        <p><strong>Destinazione:</strong> {$delivery.destination|escape}</p>
                        <p><strong>Descrizione:</strong> {$delivery.description|escape}</p>
                    </div>
                    <div class="status-actions">
                        <label for="status{$smarty.foreach.dl.iteration}">Modifica stato:</label>
                        <select id="status{$smarty.foreach.dl.iteration}" class="status-select">
                            <option value="da-ritirare" {if $delivery.status == 'da-ritirare'}selected{/if}>Da ritirare</option>
                            <option value="in-consegna" {if $delivery.status == 'in-consegna'}selected{/if}>In consegna</option>
                            <option value="consegnato" {if $delivery.status == 'consegnato'}selected{/if}>Consegnato</option>
                            <option value="errore" {if $delivery.status == 'errore'}selected{/if}>Errore</option>
                        </select>
                    </div>
                </div>
            {/foreach}

            {if $deliveries|@count == 0}
                <p>Non ci sono consegne attive.</p>
            {/if}
        </div>
    </main>

    <!-- Footer -->
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
                        statusElement.textContent = 'In consegna';
                        statusElement.classList.add('in-consegna');
                        break;
                    case 'consegnato':
                        statusElement.textContent = 'Consegnato';
                        statusElement.classList.add('consegnato');
                        break;
                    case 'errore':
                        statusElement.textContent = 'Errore';
                        statusElement.classList.add('errore');
                        break;
                    case 'da-ritirare':
                        statusElement.textContent = 'Da ritirare';
                        statusElement.classList.add('da-ritirare');
                        break;
                }
            });
        });
    });
</script>
</html>
