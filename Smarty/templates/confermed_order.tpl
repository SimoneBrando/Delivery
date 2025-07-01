<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma Ordine</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <link rel="stylesheet" href="/Smarty/css/confirm.css">
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
                <h1>Ordine Confermato</h1>

                <p>Il suo ordine è andato a buon fine! Grazie per aver scelto noi.</p>

                <a class="button" href="/Delivery/User/home">Torna alla Homepage</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    {include file="footer.tpl"}

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            localStorage.removeItem("cart");
            localStorage.removeItem("cart_createdAt");
        });
    </script>
    <script src="/Smarty/js/theme.js" defer></script>
</body>
</html>