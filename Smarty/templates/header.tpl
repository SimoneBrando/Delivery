<header>
    <div class="header-container">

        <!-- Hamburger visibile solo su mobile -->
        <button type='button' class="hamburger" id="hamburger">&#9776;</button>

        <a href="/Delivery/User/home/" class="logo">
            <img src="/Smarty/Immagini/logo.png" alt="Logo">
        </a>

        <div class="nav-links" id="nav-menu">
            <a href="/Delivery/User/home/">Home</a>
            <a href="/Delivery/User/mostraMenu/">Menù</a>
            {if $role == "cliente"}
            <a href="/Delivery/User/order/">Ordina</a>
            {/if}
            {if !($logged) }
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
            {/if}
            {if $logged and $role == "rider"}
                <a href="/Delivery/Rider/showOrders/">Ordini da Consegnare</a>
            {/if}
        </div>
        <div class="user-actions">
            <a href="admin_panel.html" title="Notifiche">
                <i class="fas fa-bell"></i>
            </a>
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
