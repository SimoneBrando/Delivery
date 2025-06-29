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

        <!-- Orders Section -->
        <section class="orders-section">

            <!-- Error Section -->
            {include file="error_section.tpl"}
            
            <h1>I Miei Ordini</h1>

            {if $orders|@count > 0}
                {foreach from=$orders item=order}
                    <div class="order-card">
                        <div class="order-header">
                            <h2>Ordine del {$order->getDataRicezione()|date_format:"%d/%m/%y"}</h2>
                            <span class="order-date">
                                {if $order->getDataEsecuzione()}
                                    {$order->getDataEsecuzione()|date_format:"%d/%m/%y"}
                                {else}
                                    Data non disponibile
                                {/if}
                            </span>
                        </div>
                        <div class="order-items">
                            <p>
                                <strong>Prodotti:</strong>
                                {foreach from=$order->getItemOrdini() item=itemOrdine name=itemLoop}
                                    {$itemOrdine->getProdotto()->getNome()}{if !$smarty.foreach.itemLoop.last},  {/if}
                                {/foreach}
                            </p>
                            <p><strong>Totale:</strong> €{$order->getCosto()}</p>
                            <p><strong>Note:</strong> {$order->getNote()|default:"-"}</p>
                            <p><strong>Stato:</strong> {$order->getStato()|capitalize}</p>
                            <p><strong>Indirizzo:</strong> {$order->getIndirizzoConsegna()->getCitta()}, {$order->getIndirizzoConsegna()->getVia()}, {$order->getIndirizzoConsegna()->getCivico()}</p>
                            <p><strong>Metodo Pagamento:</strong> {$order->getMetodoPagamento()->getNominativo()}</p>
                        </div>
                    <!-- DA MODIFICARE -->
                        {if !($order->hasWarning())}
                            <div class="order-problems">
                                <button type="button" data-modal-target="reportModal" class="btn-link-modal" data-order-id="{$order->getId()}">
                                    <i class="fas fa-exclamation-triangle"></i> Segnala problema
                                </button>
                            </div>
                        {/if}
                    </div>
                {/foreach}
            {else}
                <p>Non hai ancora effettuato ordini.</p>
            {/if}

        </section>
        {if $orders|@count > 0}
            <div class="review-conteiner">
                <a href="/Delivery/User/showReviewForm/" class="btn">Scrivi recensione!</a>
            </div>
        {/if}
    </main>


    <!-- Footer -->
    {include file="footer.tpl"}

    <!-- Modal Aggiungi Segnalazione -->
        <div id="reportModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>

                <h2>Crea segnalazione <span id="modal-order-id"></span></h2>

                <form method="POST" action="/Delivery/Segnalazione/writeReport" class="form">

                        <div class="form-group">
                            <label for="descrizione">Descrizione</label>
                            <input type="text" id="descrizione" name="descrizione" required>
                        </div>

                        <div class="form-group">
                            <label for="testo">Testo</label>
                            <input type="text" id="testo" name="testo" required>
                        </div>

                        <input type="hidden" id="ordine_id" name="ordine_id" required>

                        <button type="submit">Invia Segnalazione</button>

                </form>
            </div>
        </div>

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
    <script src="/Smarty/js/report_modal.js"></script>
</body>
</html>
