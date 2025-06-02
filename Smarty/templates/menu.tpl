{* file: menu.tpl *}
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Nome Ristorante</title>
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/layout.css">
    <script src="../Js/loadComponents.js" defer></script>
</head>
<body>
    <!-- Header -->
    <div id="header-placeholder"></div>

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

            {if $menu}
                {foreach $menu as $category}
                    <div class="menu-category">
                        <h2><i class="{$category.icon}"></i> {$category.category|escape}</h2> {* la category icon si può toglierebbe se alla fine non la mettiamo *}
                        <div class="menu-items">
                            {foreach $category.items as $item}
                                <div class="menu-item">
                                    <div class="item-info">
                                        <h3>{$item.name|escape}</h3>
                                        <p>{$item.description|escape}</p>
                                    </div>
                                    <div class="item-price">{$item.price|escape}</div>
                                </div>
                            {/foreach}
                        </div>
                    </div>
                {/foreach}
            {else}
                <p>Menù non disponibile</p>
            {/if}
        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>
</body>
</html>
