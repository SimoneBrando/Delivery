<?php
/* Smarty version 5.5.1, created on 2025-07-11 01:43:42
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6870502ea90265_40535017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14480e0397d18fd823be1c34e12f9063673c3c8c' => 
    array (
      0 => 'home.tpl',
      1 => 1751894239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6870502ea90265_40535017 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Restaurant - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
</head>
<body>
    <!-- Header -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <!-- Navigation Tabs -->
        <section class="tabs">
            <a class="tab" href="#storia">Storia</a>
            <a class="tab" href="#posizione">Dove siamo?</a>
            <a class="tab" href="#recensioni">Recensioni</a>
            <a class="tab" href="#contatti">Contatti</a>
        </section>

        <!-- Story Sections -->
        
        <section id="storia" class="story-section">
            <div class="storia-container">
                <div class="storia-text">
                    <h2>Storia del ristorante</h2>
                    <p>
                        Tutto è partito da una semplice idea:
                        tre soci, una passione per la pizza e la voglia di creare qualcosa di nostro. Poi &egrave; arrivato il Covid. Le restrizioni ci hanno costretti a rivedere i piani: niente sala, solo consegne.
                        Cos&igrave; è nata Home Restaurant, una pizzeria pensata per portare la qualità a casa, quando uscire non era possibile.
                    </p><br>
                    <p>
                        Da l&igrave; non ci siamo pi&ugrave; fermati!
                    </p>
                </div>
                <div class="storia-image">
                    <img src="/Smarty/Immagini/story.jpeg" alt="Storia del ristorante">
                </div>
            </div>
        </section>

         <!-- Position Section -->

         <section id="posizione" class="position-section">
            <div class="position-container">
                <div class="position-image">
                    <img src="/Smarty/Immagini/position.png" alt="Storia del ristorante">
                </div>
                <div class="position-text">
                    <h2>Dove siamo?</h2>
                    <p>
                        Ci troviamo nel pieno centro storico dell'Aquila, tra pietra, storia e movida. Una zona che vive di incontri, sapori e serate che iniziano con una pizza e finiscono con una storia da raccontare.
                        Se passi da qui, lo capisci subito: sei nel posto giusto!
                    </p>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->

        <section id="recensioni" class="reviews">
            <h2>Recensioni</h2>
            <div class="review-grid">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                    <div class="review-card">
                        <div class="reviewer-info">
                           <div class="reviewer-details">
                                <h3>
                                    Valutazione: <?php echo $_smarty_tpl->getValue('review')->getVoto();?>
 
                                    <i class="fas fa-star" style="color: gold; margin-left: 5px;"></i>
                                </h3>
                            </div>
                        </div>
                        <p class="review-text">"<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('review')->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
"</p>
                        <span class="review-date">"<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('review')->getData(),"%H:%M %e %B %Y");?>
"</span>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        </section>


        <!-- Contacts Section -->
        <section id="contatti" class="contacts">
            <h2>Contatti</h2>
            <ul>
                <li><i class="fas fa-phone"></i> 06 1234 5678</li>
                <li><i class="fas fa-mobile-alt"></i> 345 678 9012</li>
                <li><i class="fas fa-envelope"></i> info@deliveryhomerestaurant.altervista.org</li>
                <li><i class="fas fa-envelope"></i> commerciale@deliveryhomerestauranthomerestaurant.it</li>
                <li><i class="fas fa-calendar-alt"></i> Giorni e orari di chiusura</li>
            </ul>
            <div class="orari-apertura">
                <h3><i class="fas fa-door-open"></i> Orari di Apertura</h3>
                <table>
                    <tr>
                        <td>Lunedì</td>
                        <td><strong>Chiuso</strong></td>
                    </tr>
                    <tr>
                        <td>Martedì - Giovedì</td>
                        <td>19:00 - 22:30</td>
                    </tr>
                    <tr>
                        <td>Venerdì - Sabato</td>
                        <td>19:00 - 23:30</td>
                    </tr>
                    <tr>
                        <td>Domenica</td>
                        <td>19:00 - 23:00</td>
                    </tr>
                </table>
                <p class="note">* Esclusi festivi.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    
    
    <?php echo '<script'; ?>
 src="/Smarty/Js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/theme.js" defer><?php echo '</script'; ?>
>
    <?php if ($_smarty_tpl->getValue('logout')) {?>
        <?php echo '<script'; ?>
>
            localStorage.removeItem('cart');
            localStorage.removeItem('cart_createdAt');
        <?php echo '</script'; ?>
>
    <?php }?>
</body>

</html><?php }
}
