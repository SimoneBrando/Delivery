<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

    <!-- Main Section -->   
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <!-- Login Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-image">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Login Image">
                </div>
                <div class="login-form">
                    <h1>Accedi al tuo Account</h1>

                    {if isset($error)}
                        <div class="error-message">{$error}</div>
                    {/if}

                    <form action="/Delivery/User/loginUser" method="POST">
                        <div class="form-group">
                            <label for="username">Nome Utente</label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                required
                                value="{$username|default:''|escape:'html'}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                value="{$password|default:''|escape:'html'}"
                            >
                        </div>
                        <div class="form-group remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe" value="1">
                            <label for="rememberMe">Ricordami</label> <!-- metti qui il metodo per fare il remember -->
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Accedi</button>
                        </div>
                        <div class="form-group">
                            <p>Non hai un account? <a href="/Delivery/User/showRegisterForm">Registrati</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
</body>
</html>
