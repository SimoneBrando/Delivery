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
            
            <!-- Ordini Pronti -->
            <h2>Ordini Pronti</h2>
            {foreach $orders as $order}
                <div class="delivery-card">
                    <div class="delivery-header">
                        <h3>Ordine #{$order->getId()}</h3>
                        {assign var=statoClasse value=''}
                        {if $order->getStato() == 'annullato'}
                            {assign var=statoClasse value='annullato'}
                        {elseif $order->getStato() == 'consegnato'}
                            {assign var=statoClasse value='consegnato'}
                        {elseif $order->getStato() == 'pronto'}
                            {assign var=statoClasse value='pronto'}
                        {elseif $order->getStato() == 'in_preparazione'}
                            {assign var=statoClasse value='in_preparazione'}
                        {elseif $order->getStato() == 'in_attesa'}
                            {assign var=statoClasse value='errore'}
                        {elseif $order->getStato() == 'in_consegna'}
                            {assign var=statoClasse value='in_consegna'}
                        {/if}
                        <span class="order-status {$statoClasse|escape}">{$order->getStato()|replace:"_":" "|capitalize}</span>
                    </div>
                    <div class="delivery-info">
                        <p><strong>Note:</strong> {$order->getNote()|escape}</p>
                        <p><strong>Data esecuzione:</strong> {$order->getDataEsecuzione()->format('d/m/Y H:i:s')}</p>
                        <p><strong>Data ricezione:</strong> {$order->getDataRicezione()->format('d/m/Y H:i:s')}</p>
                        <p><strong>Costo totale:</strong> €{$order->getCosto()}</p>
                        <p><strong>Prodotti:</strong></p>
                        <ul>
                            {foreach $order->getItemOrdini() as $itemOrdine}
                                <li>{$itemOrdine->getProdotto()->getNome()|escape} - {$itemOrdine->getProdotto()->getDescrizione()|escape} - qty: {$itemOrdine->getQuantita()} - €{$itemOrdine->getPrezzoUnitarioAlMomento()}</li>
                            {/foreach}
                        </ul>
                    </div>
                    <form method="POST" action="/Delivery/Rider/cambiaStatoOrdine" class="status-form">
                        <input type="hidden" name="ordineId" value="{$order->getId()}">
                        <label for="status{$order->getId()}">Modifica stato:</label>
                        <select name="stato" id="status{$order->getId()}" class="status-select">
                            <option value="">-- Seleziona stato --</option>
                            {if $statoClasse == 'pronto'}
                                <option value="pronto" selected>Pronto</option>
                            {/if}
                            <option value="in_consegna" {if $statoClasse == 'in_consegna'}selected{/if}>In Consega</option>
                            <option value="consegnato" {if $statoClasse == 'consegnato'}selected{/if}>Consegnato</option>
                        </select>
                    </form>
                </div>
            {/foreach}
        </div>

        <div class="deliveries-container">
            <!-- Ordini In Consegna -->
            <h2>Ordini In Consegna</h2>
            {foreach $ordersOnDelivery as $order}
                <div class="delivery-card">
                    <div class="delivery-header">
                        <h3>Ordine #{$order->getId()}</h3>
                        {assign var=statoClasse value=''}
                        {if $order->getStato() == 'annullato'}
                            {assign var=statoClasse value='annullato'}
                        {elseif $order->getStato() == 'consegnato'}
                            {assign var=statoClasse value='consegnato'}
                        {elseif $order->getStato() == 'pronto'}
                            {assign var=statoClasse value='pronto'}
                        {elseif $order->getStato() == 'in_preparazione'}
                            {assign var=statoClasse value='in_preparazione'}
                        {elseif $order->getStato() == 'in_attesa'}
                            {assign var=statoClasse value='errore'}
                        {elseif $order->getStato() == 'in_consegna'}
                            {assign var=statoClasse value='in_consegna'}
                        {/if}
                        <span class="order-status {$statoClasse|escape}">{$order->getStato()|replace:"_":" "|capitalize}</span>
                    </div>
                    <div class="delivery-info">
                        <p><strong>Note:</strong> {$order->getNote()|escape}</p>
                        <p><strong>Data esecuzione:</strong> {$order->getDataEsecuzione()->format('d/m/Y H:i:s')}</p>
                        <p><strong>Data ricezione:</strong> {$order->getDataRicezione()->format('d/m/Y H:i:s')}</p>
                        <p><strong>Costo totale:</strong> €{$order->getCosto()}</p>
                        <p><strong>Prodotti:</strong></p>
                        <ul>
                            {foreach $order->getItemOrdini() as $itemOrdine}
                                <li>{$itemOrdine->getProdotto()->getNome()|escape} - {$itemOrdine->getProdotto()->getDescrizione()|escape} - qty: {$itemOrdine->getQuantita()} - €{$itemOrdine->getPrezzoUnitarioAlMomento()}</li>
                            {/foreach}
                        </ul>
                    </div>
                    <form method="POST" action="/Delivery/Rider/cambiaStatoOrdine" class="status-form">
                        <input type="hidden" name="ordineId" value="{$order->getId()}">
                        <label for="status{$order->getId()}">Modifica stato:</label>
                        <select name="stato" id="status{$order->getId()}" class="status-select">
                            <option value="">-- Seleziona stato --</option>
                            {if $statoClasse == 'pronto'}
                                <option value="pronto" selected>Pronto</option>
                            {/if}
                            <option value="in_consegna" {if $statoClasse == 'in_consegna'}selected{/if}>In Consega</option>
                            <option value="consegnato" {if $statoClasse == 'consegnato'}selected{/if}>Consegnato</option>
                        </select>
                    </form>
                </div>
            {/foreach}
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

    <script src="/Smarty/js/orders.js"></script>
    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
</body>


</html>
