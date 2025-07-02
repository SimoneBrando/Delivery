<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Restaurant - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
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

            <!-- Error Section -->
            {include file="error_section.tpl"}

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

            {if $role=="cliente"}
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
                                    <button type="submit" class="remove-address-btn" title="Rimuovi Indirizzo">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <p>Nessun indirizzo registrato.</p>
                {/if}
                    <button type="button" data-modal-target="addressModal" class="btn-link-modal">
                        <i class="fas fa-plus"></i> Aggiungi indirizzo
                    </button>
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
                    <button type="button" data-modal-target="cardModal" class="btn-link-modal">
                        <i class="fas fa-plus"></i> Aggiungi carta
                    </button>
            </div>
            

            <!-- Link ai miei ordini -->
            <div class="orders-link">
                <a href="/Delivery/User/showMyOrders/" class="btn-link">
                    <i class="fas fa-box-open"></i> I miei ordini
                </a>
            </div>
            {/if}

            <!-- Logout -->
            <div class="logout-section">
                <a href="/Delivery/User/logoutUser/" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <a href="#" class="btn-logout" onclick="openDeleteModal()">
                    <i class="fas fa-sign-out-alt"></i> Elimina Account
                </a>
            </div>
        </section>

    </main>

    <!-- Footer -->

    {include file="footer.tpl"}

    <!-- Modal Aggiungi Indirizzo -->
        <div id="addressModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>

                <h2>Aggiungi un nuovo indirizzo</h2>

                <form method="POST" action="/Delivery/User/addAddress" class="form">

                        <div class="form-group">
                            <label for="via">Via</label>
                            <input type="text" id="via" name="via" required>
                        </div>

                        <div class="form-group">
                            <label for="civico">Civico</label>
                            <input type="text" id="civico" name="civico" pattern="^[0-9]+[a-zA-Z]?$" required>
                        </div>

                        <div class="form-group">
                            <label for="citta">Città</label>
                            <select id="citta" name="citta" required>
                                <option value="">-- Seleziona una città --</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cap">CAP</label>
                            <input type="text" id="cap" name="cap" pattern="\d&#123;5&#125;" inputmode="numeric" maxlength="5" title="Inserisci un CAP valido (5 cifre)"  readonly required>
                        </div>

                        <button type="submit">Salva Indirizzo</button>

                </form>
            </div>
        </div>

    <!-- Modal Aggiungi Carta -->
        <div id="cardModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>

                <h2>Aggiungi un nuovo metodo di pagamento</h2>

                <form method="POST" action="/Delivery/User/addCreditCard" class="form">

                    <div class="form-group">
                        <label for="nome_carta">Nominativo Carta</label>
                        <input type="text" id="nome_carta" name="nome_carta" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_carta">Numero Carta</label>
                        <input type="text" id="numero_carta" name="numero_carta" pattern="^\d&#123;16&#125;$" inputmode="numeric" maxlength="16" title="Inserisci 16 cifre numeriche" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" pattern="^\d&#123;3,4&#125;$" inputmode="numeric" maxlength="4" title="Inserisci un CVV di 3 o 4 cifre" required>
                    </div>

                    <div class="form-group">
                        <label for="nome_intestatario">Nome Intestatario</label>
                        <input type="text" id="nome_intestatario" name="nome_intestatario" pattern="^[a-zA-ZÀ-ÿ' ]&#123;2,50&#125;$" title="Inserisci un nome valido (solo lettere e spazi)" required>
                    </div>

                    <div class="form-group">
                        <label for="data_scadenza">Data Scadenza</label>
                        <input type="text" id="data_scadenza" name="data_scadenza" pattern="^(0[1-9]|1[0-2])\/\d&#123;2&#125;$" inputmode="numeric" placeholder="MM/AA" required>
                    </div>

                    <button type="submit">Salva Metodo di Pagamento</button>

                </form>
            </div>
        </div>
    
    {* Modale personalizzato - versione semplificata *}
    <div id="deleteConfirmModal" class="modal">
        <div class="modal-content">
            <p>Sei sicuro di voler <strong>eliminare definitivamente</strong> il tuo account?</p>
            <div class="modal-buttons">
                <a href="/Delivery/User/deleteAccount/" class="btn-confirm">Conferma eliminazione</a>
                <button onclick="closeModal()" class="btn-cancel">Annulla</button>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('citta');
            const capInput = document.getElementById('cap');

            fetch('/Smarty/comuni_aq.json')
                .then(response => response.json())
                .then(comuni => {
                    comuni.forEach(comune => {
                        const option = document.createElement('option');
                        option.value = comune.nome;
                        option.textContent = comune.nome;
                        option.dataset.cap = comune.cap[0]; // usa il primo CAP disponibile
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Errore nel caricamento dei comuni:', error);
                });

            select.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const cap = selectedOption.dataset.cap;
                if (cap) {
                    capInput.value = cap;
                }
            });
        });

        function openDeleteModal() {
            event.preventDefault();
            document.getElementById('deleteConfirmModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteConfirmModal').style.display = 'none';
        }

        // Chiudi il modal cliccando fuori dall'area del contenuto
        window.onclick = function(event) {
            const modal = document.getElementById('deleteConfirmModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    
    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>
    <script src="/Smarty/js/modal.js" defer></script>

</body>

</html>