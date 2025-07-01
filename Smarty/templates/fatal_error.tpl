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
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>
    <!-- Header -->
    
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>
        <section>
            <div>
                <h1>Problema Insolito</h1>

                <p>C'è stato un problema indesiderato. {$message}. La invitiamo a tornare alla Homepage.</p>

                <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
            </div>
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

</body>
</html>