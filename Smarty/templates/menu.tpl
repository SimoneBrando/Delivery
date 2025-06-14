{* file: menu.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="menu-section">
            <h1>Menù</h1>

            {foreach $menu as $categoria}
                <div class="menu-category">
                    <h2>{$categoria.categoria|escape}</h2>
                    <div class="menu-items">
                        {foreach $categoria.piatti as $piatto}
                            <div class="menu-item">
                                <div class="item-info">
                                    <h3>{$piatto.nome|escape}</h3>
                                    <p>{$piatto.descrizione|escape}</p>
                                </div>
                                <div class="item-price">€{$piatto.costo|escape}</div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            {/foreach}
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
</body>
</html>

