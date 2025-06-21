<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Restaurant - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
</head>
<body>
    <!-- Header -->
    
    {include file="header.tpl"}
    

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="account-container">
            <h2>Gestione Account</h2>

            <!-- Modifica Profile -->
            <div class="password-section">
                <h3>Modifica Profilo</h3>
                <form action="/Delivery/User/modifyProfile" method="POST">
                    <div class="form-group">
                        <label for="newName">Nuovo Nome</label>
                        <input id="newName" name="newName" value="{$utente->getNome()}" required>
                    </div>

                    <div class="form-group">
                        <label for="newSurname">Nuovo Cognome</label>
                        <input id="newSurname" name="newSurname" value="{$utente->getCognome()}" required>
                    </div>

                    <button type="submit" class="btn-submit">Aggiorna Profilo</button>
                </form>
            </div>

            <!-- Cambia Password -->
            <div class="password-section">
                <h3>Cambia Password</h3>
                <form action="/Delivery/User/changePassword" method="POST">
                    <div class="form-group">
                        <label for="oldPassword">Vecchia Password</label>
                        <input type="password" id="oldPassword" name="oldPassword" required>
                    </div>

                    <div class="form-group">
                        <label for="newPassword">Nuova Password</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>

                    <button type="submit" class="btn-submit">Aggiorna Password</button>
                </form>
            </div>

            <!-- Sezione Indirizzi -->
            <div class="address-section">
                <h3>I miei indirizzi</h3>
                {if count($indirizzi) > 0}
                    <ul class="address-list">
                        {foreach $indirizzi as $indirizzo}
                            <li class="address-item">
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {$indirizzo->getVia()}, {$indirizzo->getCivico()}, {$indirizzo->getCap()} {$indirizzo->getCitta()}
                                </span>
                                <form action="/Delivery/User/removeAddress" method="POST" class="remove-address-form">
                                    <input type="hidden" name="indirizzo_id" value="{$indirizzo->getId()}">
                                    <button type="submit" class="remove-address-btn" title="Rimuovi indirizzo">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <p>Nessun indirizzo registrato.</p>
                {/if}
                <a href="/Delivery/User/showAddressForm/" class="btn-link">
                    <i class="fas fa-plus"></i> Aggiungi indirizzo
                </a>
            </div>

            <!-- Sezione Carte di Credito -->
            <div class="credit-cards-section">
                <h3>Le mie carte di credito</h3>
                {if count($carte_credito) > 0}
                    <ul class="cards-list">
                        {foreach $carte_credito as $carta}
                            <li class="card-item">
                                <span>
                                    <i class="far fa-credit-card"></i>
                                    {$carta->getNominativo()}
                                </span>
                                <form action="/Delivery/User/removeCreditCard" method="POST" class="remove-card-form">
                                    <input type="hidden" name="numero_carta" value="{$carta->getNumeroCarta()}">
                                    <button type="submit" class="remove-card-btn" title="Rimuovi Metodo di Pagamento">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <p>Nessuna carta di credito registrata.</p>
                {/if}
                <a href="/Delivery/User/showCreditCardForm/" class="btn-link">
                    <i class="fas fa-plus"></i> Aggiungi carta
                </a>
            </div>

            <!-- Link ai miei ordini -->
            <div class="orders-link">
                <a href="/Delivery/User/showMyOrders/" class="btn-link">
                    <i class="fas fa-box-open"></i> I miei ordini
                </a>
            </div>

            <!-- Logout -->
            <div class="logout-section">
                <a href="/Delivery/User/logoutUser/" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <a href="/Delivery/User/deleteAccount/" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Delete Account
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->
    
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
    
</body>

</html>