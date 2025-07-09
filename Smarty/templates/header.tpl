<header>
    <!-- Avviso se JavaScript è disabilitato -->
    <noscript>
        <div class="alert alert-danger text-center m-0" role="alert">
            Attenzione: questo sito richiede JavaScript per funzionare correttamente. Abilitalo nel tuo browser.
        </div>
    </noscript>
    
    <!-- Avviso se i cookie sono disabilitati -->
    <div id="cookie-warning" style="display: none; background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border: 1px solid #f5c6cb;">
        Attenzione: questo sito richiede l'uso dei cookie per funzionare correttamente. Abilitali nel tuo browser.
    </div>

    <script>
        // Controlla se i cookie sono abilitati
        if (!navigator.cookieEnabled) {
            document.getElementById('cookie-warning').style.display = 'block';
        }
    </script>

    <div class="header-container">

        <!-- Hamburger visibile solo su mobile -->
        <button type='button' class="hamburger" id="hamburger">&#9776;</button>

        <a href="/Delivery/User/home/" class="logo">
            <img src="/Smarty/Immagini/logo.png" alt="Logo">
        </a>

        <div class="nav-links" id="nav-menu">
            <a href="/Delivery/User/home/">Home</a>
            <a href="/Delivery/User/mostraMenu/">Menù</a>
            {if $role == "cliente" or !$logged}
            <a href="/Delivery/User/order/">Ordina</a>
            {/if}
            {if $logged and $role == "cliente"}
                <a href="/Delivery/User/showMyOrders/">I Miei Ordini</a>
            {/if}
            {if $logged and $role == "proprietario"}
                <a href="/Delivery/Proprietario/showPanel/">Pannello di Controllo</a>
            {/if}
            {if $logged and $role == "cuoco"}
                <a href="/Delivery/Chef/showOrders/">Ordini in Cucina</a>
                <a href="/Delivery/Chef/showOrdiniInAttesa/">Ordini in Attesa</a>
            {/if}
            {if $logged and $role == "rider"}
                <a href="/Delivery/Rider/showOrders/">Ordini da Consegnare</a>
            {/if}
        </div>
        <div class="user-actions">
            <a href="/Delivery/User/showProfile" title="Profilo">
                <i class="fas fa-user"></i>
            </a>
            <button id="theme-toggle" class="theme-toggle" aria-label="Cambia tema">
                <i class="fas fa-moon"></i>
                <span class="toggle-text">Scuro</span>
            </button>
        </div>
    </div>

    <script src="/Smarty/Js/hamburger.js" defer></script>
</header>
