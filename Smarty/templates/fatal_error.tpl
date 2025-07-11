<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accesso Negato</title>
  <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
  <link rel="stylesheet" href="/Smarty/css/layout.css">
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
        <i class="fas fa-circle-exclamation fork"></i>
      </div>

      <h1>Errore Imprevisto</h1>
      <p>{$message}</p>
      <p>Si è verificato un errore inatteso. Ti invitiamo a tornare alla homepage e riprovare.</p>
      <a class="button" href="/Delivery/User/home"><i class="fas fa-home"></i> Torna alla Homepage</a>
    </section>
  </main>

  <!-- Footer -->
  {include file="footer.tpl"}

  {if $cartError}
    <script>
      localStorage.removeItem('cart');
      localStorage.removeItem('cart_createdAt');
    </script>
  {/if}

  <script src="/Smarty/Js/hamburger.js"></script>
  <script src="/Smarty/Js/theme.js" defer></script>

</body>
</html>
