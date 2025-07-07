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

        <span class="order-status {$statoClasse|escape}">
            {$order->getStato()|replace:"_":" "|capitalize}
        </span>
    </div>

    <div class="delivery-info">
        <p><strong>Note:</strong> {$order->getNote()|escape}</p>
        <p><strong>Data esecuzione:</strong> {$order->getDataEsecuzione()->format('d/m/Y H:i:s')}</p>
        <p><strong>Data ricezione:</strong> {$order->getDataRicezione()->format('d/m/Y H:i:s')}</p>
        <p><strong>Costo totale:</strong> €{$order->getCosto()}</p>
        <p><strong>Prodotti:</strong></p>
        <ul>
            {foreach $order->getItemOrdini() as $itemOrdine}
                <li>{$itemOrdine->getProdotto()->getNome()|escape} - 
                    {$itemOrdine->getProdotto()->getDescrizione()|escape} - 
                    qty: {$itemOrdine->getQuantita()} - 
                    €{$itemOrdine->getPrezzoUnitarioAlMomento()}
                </li>
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
            <option value="in_consegna" {if $statoClasse == 'in_consegna'}selected{/if}>In Consegna</option>
            <option value="consegnato" {if $statoClasse == 'consegnato'}selected{/if}>Consegnato</option>

            {if $showExtraStatuses}
                <option value="in_preparazione" {if $statoClasse == 'in_preparazione'}selected{/if}>In Preparazione</option>
                <option value="in_attesa" {if $statoClasse == 'errore'}selected{/if}>In Attesa</option>
            {/if}
        </select>
    </form>
</div>
