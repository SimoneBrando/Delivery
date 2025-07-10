<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera Password - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
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

        <!-- Recupero Password Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-image">
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Recupero Password">
                </div>
                <div class="login-form">
                    <h1>Recupera la tua Password</h1>

                    <!-- Error Section -->
                    {include file="error_section.tpl"}

                    <form action="/Delivery/User/resetPassword" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="selector" value={$selector}>
                            <input type="hidden" name="token" value={$token}>
                            <label>Nuova Password:</label>
                            <input type="password" name="password" required placeholder="Nuova Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Modifica Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/Js/hamburger.js"></script>
    <script src="/Smarty/Js/theme.js" defer></script>
</body>
</html>