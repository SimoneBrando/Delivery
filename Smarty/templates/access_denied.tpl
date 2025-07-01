<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso Negato</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <link rel="stylesheet" href="/Smarty/css/error.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>
      <section class="accesso-negato-container">
        <div class="crossed-utensils">
          <i class="fas fa-utensils fork "></i>
        </div>

        <h1>Accesso Negato</h1>
        <p>Non hai i permessi necessari per accedere a questa sezione.</p>
        <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
      </section>
    </main>

    <!-- Footer -->
    
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js" defer></script>

</body>
</html>