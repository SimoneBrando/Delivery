<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cucina - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/personale_cucina.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../css/layout.css" />
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>
    <div id="header-placeholder"></div>

    <main>
        <div class="deliveries-container">
            {foreach from=$orders item=order}
            <div class="delivery-card">
                <div class="delivery-header">
                    <h3>Ordine #{$order.id}</h3>
                    <span class="order-status {$order.status_class}">{$order.status_text}</span>
                </div>
                <div class="delivery-info">
                    <p><strong>Posizione:</strong> {$order.pickup_address}</p>
                    <p><strong>Destinazione:</strong> {$order.delivery_address}</p>
                    <p><strong>Descrizione:</strong> {$order.description}</p>
                </div>
                <div class="status-actions">
                    <label for="status{$order.id}">Modifica stato:</label>
                    <select id="status{$order.id}" class="status-select">
                        <option value="da-preparare" {if $order.status == 'da-preparare'}selected{/if}>Da preparare</option>
                        <option value="in-preparazione" {if $order.status == 'in-preparazione'}selected{/if}>In preparazione</option>
                        <option value="pronto" {if $order.status == 'pronto'}selected{/if}>Pronto</option>
                        <option value="errore" {if $order.status == 'errore'}selected{/if}>Errore</option>
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

            statusElement.classList.remove('in-preparazione', 'pronto', 'errore', 'da-preparare');

            switch(newStatus) {
                case 'in-preparazione':
                    statusElement.classList.add('in-preparazione');
                    break;
                case 'pronto':
                    statusElement.classList.add('pronto');
                    break;
                case 'errore':
                    statusElement.classList.add('errore');
                    break;
                case 'da-preparare':
                    statusElement.classList.add('da-preparare');
                    break;
            }
        });
    });
});
</script>
</html>
