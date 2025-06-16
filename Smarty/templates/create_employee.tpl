<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati - Nome Ristorante</title>
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
                    <h1>Crea account per nuovo dipendente</h1>

                    {if isset($error)}
                        <div class="error-message">{$error}</div>
                    {/if}

                    <form action="/Delivery/Proprietario/createEmployee" method="POST">
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
                            <label for="ruolo">Ruolo</label>
                            <select name="ruolo" id="ruolo" class="status-select" required>
                                <option value="">-- Seleziona stato --</option>
                                <option value="Cuoco"> Cuoco </option>
                                <option value="Rider"> Rider </option>
                            </select>   
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn">Crea account</button>
                            <button type="reset" >Svuota campi</button>
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


</body>
</html>
