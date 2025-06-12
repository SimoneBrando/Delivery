<?php
/* Smarty version 5.5.1, created on 2025-06-11 10:05:42
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684938d6b14b80_10362491',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14480e0397d18fd823be1c34e12f9063673c3c8c' => 
    array (
      0 => 'home.tpl',
      1 => 1749629058,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684938d6b14b80_10362491 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Restaurant - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
    <?php echo '<script'; ?>
 src="/Smarty/Js/loadComponents.js" defer><?php echo '</script'; ?>
>
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
            <form action="/Delivery/User/showChangePassword" method="POST">
                <div class="form-group">
                    <button type="submit" class="btn">Cambia Password</button>
                </div>
            </form>
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
                        <span class="review-date"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('review')->getData(),"%d/%m/%Y");?>
 <?php echo $_smarty_tpl->getValue('review')->getOrario();?>
</span>
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
                <li><i class="fas fa-envelope"></i> info@homerestaurant.it</li>
                <li><i class="fas fa-envelope"></i> commerciale@homerestaurant.it</li>
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
                        <td>12:00 - 15:00 | 19:00 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Venerdì - Sabato</td>
                        <td>12:00 - 15:00 | 19:00 - 00:00</td>
                    </tr>
                    <tr>
                        <td>Domenica</td>
                        <td>12:00 - 15:00 | 19:00 - 22:30</td>
                    </tr>
                </table>
                <p class="note">* Apertura straordinaria su prenotazione per gruppi.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    
    <div id="footer-placeholder"></div>
    
</body>

</html><?php }
}
