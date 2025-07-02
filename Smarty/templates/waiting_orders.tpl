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
        <div class="deliveries-container">
            {if $orders|@count > 0}
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
                            {/if}
                            <span class="order-status {$statoClasse|escape}">{$order->getStato()|replace:"_":" "|capitalize}</span>
                        </div>
                        <div class="delivery-info">
                            <p><strong>Note:</strong> {$order->getNote()|escape}</p>
                            <p><strong>Data esecuzione:</strong> {$order->getDataEsecuzione()->format('d/m/Y H:i:s')}</p>
                            <p><strong>Data consegna prevista:</strong> {$order->getDataRicezione()->format('d/m/Y H:i:s')}</p>
                            <p><strong>Indirizzo :</strong> {$order->getIndirizzoConsegna()->getVia()} {$order->getIndirizzoConsegna()->getCivico()}, {$order->getIndirizzoConsegna()->getCitta()}</p>
                            <p><strong>Costo totale:</strong> €{$order->getCosto()}</p>
                            <p><strong>Prodotti:</strong></p>
                            <ul>
                                {foreach $order->getItemOrdini() as $itemOrdine}
                                    <li>{$itemOrdine->getProdotto()->getNome()|escape} - {$itemOrdine->getProdotto()->getDescrizione()|escape} - qty: {$itemOrdine->getQuantita()} - €{$itemOrdine->getPrezzoUnitarioAlMomento()}</li>
                                {/foreach}
                            </ul>
                        </div>
                        <div class="delivery-actions">
                            <form action="/Delivery/Chef/accettaOrdine" method="POST" style="display:inline-block; margin-right: 10px;">
                                <input type="hidden" name="ordine_id" value="{$order->getId()}" />
                                <button type="submit" class="btn btn-success">Accetta</button>
                            </form>

                            <form action="/Delivery/Chef/rifiutaOrdine" method="POST" style="display:inline-block;">
                                <input type="hidden" name="ordine_id" value="{$order->getId()}" />
                                <textarea name="motivazione_rifiuto" placeholder="Motivazione rifiuto" rows="2" cols="30" required style="resize: none; margin-bottom: 5px;"></textarea>
                                <br>
                                <button type="submit" class="btn btn-danger">Rifiuta</button>
                            </form>
                        </div>
                    </div>
                {/foreach}
            {else}
                <p>Nessun ordine in attesa.</p>
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



    <script src="/Smarty/js/orders.js"></script>
    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>

</body>

</html>
