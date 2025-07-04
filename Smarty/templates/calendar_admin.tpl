<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Calendario | Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/admin_calendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

    <main class="admin-container">
        <div class="admin-header">
            <a href="/Delivery/Proprietario/showPanel" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1><i class="fas fa-calendar-alt"></i> Gestione Calendario</h1>
            <p class="admin-subtitle">Configura gli orari settimanali e le chiusure straordinarie</p>
        </div>

       <section class="calendar-section">

       {include file="error_section.tpl"}
            <h2><i class="fas fa-clock"></i> Orari Settimanali</h2>

            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Giorno</th>
                        <th>Apertura</th>
                        <th>Chiusura</th>
                        <th>Stato</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                {foreach from=$giorniChiusuraSettimanali item=day}
                    <tr>
                        <form method="post" action="/Delivery/Proprietario/editDay">
                            <td>{$day->getData()}</td>
                            <td>
                                <input type="time" name="orari[apertura]" 
                                    value="{if $day->getOrarioApertura() neq null}{$day->getOrarioApertura()->format('H:i')}{/if}">
                            </td>
                            <td>
                                <input type="time" name="orari[chiusura]" 
                                    value="{if $day->getOrarioChiusura() neq null}{$day->getOrarioChiusura()->format('H:i')}{/if}">
                            </td>
                            <td>
                                <select name="orari[stato]">
                                    <option value="aperto" {if $day->isAperto() == 1}selected{/if}>Aperto</option>
                                    <option value="chiuso" {if $day->isAperto() == 0}selected{/if}>Chiuso</option>
                                </select>
                            </td>
                            <td>
                                <!-- Inviamo anche il giorno per identificare quale aggiornare -->
                                <input type="hidden" name="giorno" value="{$day->getData()}">
                                <button type="submit" class="btn-save">Aggiorna</button>
                            </td>
                        </form>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </section>


        <!-- Chiusure Straordinarie -->
        <section class="calendar-section">
            <h2><i class="fas fa-ban"></i> Chiusure Straordinarie</h2>

            <!-- Aggiunta -->
            <form method="post" action="/Delivery/Proprietario/addExceptionDay" class="add-date-form">
                <label for="dataChiusura"><i class="fas fa-plus-circle"></i> Aggiungi data di chiusura:</label>
                <input type="date" name="dataChiusura" required>
                <button type="submit" class="btn-add">Aggiungi</button>
            </form>

            <!-- Elenco -->
            {if $giorniChiusuraEccezionali|@count > 0}
                <table class="calendar-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$giorniChiusuraEccezionali item=eccezione}
                        <tr>
                            <td>{$eccezione->getExceptionDate()->format('d/m/Y')}</td>
                            <td>
                                <form method="post" action="/Delivery/Proprietario/deleteExceptionDay" class="remove-date-form">
                                    <input type="hidden" name="dataChiusura" value="{$eccezione->getExceptionDate()->format('Y-m-d')}">
                                    <button type="submit" class="btn-remove"><i class="fas fa-trash-alt"></i> Rimuovi</button>
                                </form>
                            </td>
                        </tr>
                    {/foreach}

                    </tbody>
                </table>
            {else}
                <p class="no-entries"><i class="fas fa-info-circle"></i> Nessuna chiusura straordinaria impostata.</p>
            {/if}
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js"></script>
</body>
</html>
