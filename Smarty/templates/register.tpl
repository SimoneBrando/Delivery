<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/registrati.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <!-- Registration Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-form">
                    <h1>Registrati</h1>

                    <!-- Error Section -->
                    {include file="error_section.tpl"}

                    <form action="/Delivery/User/registerUser" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input 
                                type="text" 
                                id="nome" 
                                name="nome" 
                                required 
                                value="{$name|default:''|escape:'html'}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="cognome">Cognome</label>
                            <input 
                                type="text" 
                                id="cognome" 
                                name="cognome" 
                                required 
                                value="{$cognome|default:''|escape:'html'}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required 
                                value="{$email|default:''|escape:'html'}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                            >
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn">Registrati</button>
                        </div>
                        <div class="form-group">
                            <p>Sei già registrato? <a href="/Delivery/User/showLoginForm">Accedi</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>

    {literal}
    <script>
        document.getElementById('phone').addEventListener('input', function(e) {
            let phoneNumber = e.target.value.replace(/\D/g, ''); // solo numeri
            phoneNumber = phoneNumber.slice(0, 10); // massimo 10 cifre

            if (phoneNumber.length <= 3) {
                e.target.value = phoneNumber;
            } else if (phoneNumber.length <= 6) {
                e.target.value = phoneNumber.replace(/(\d{3})(\d{0,3})/, '$1 $2');
            } else {
                e.target.value = phoneNumber.replace(/(\d{3})(\d{3})(\d{0,4})/, '$1 $2 $3');
            }
        });
    </script>
    {/literal}

</body>
</html>
