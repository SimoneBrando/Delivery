<?php
/* Smarty version 5.5.1, created on 2025-07-09 10:01:07
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686e21c32e8cd7_68338735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2782fd097f6af45548f5e7574f5c13c1862b177b' => 
    array (
      0 => 'header.tpl',
      1 => 1752048008,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_686e21c32e8cd7_68338735 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><header>
    <!-- Avviso se JavaScript è disabilitato -->
    <noscript>
        <div class="alert alert-danger text-center m-0" role="alert">
            Attenzione: questo sito richiede JavaScript per funzionare correttamente. Abilitalo nel tuo browser.
        </div>
    </noscript>
    
    <!-- Avviso se i cookie sono disabilitati -->
    <div id="cookie-warning" style="display: none; background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center; border: 1px solid #f5c6cb;">
        Attenzione: questo sito richiede l'uso dei cookie per funzionare correttamente. Abilitali nel tuo browser.
    </div>

    <?php echo '<script'; ?>
>
        // Controlla se i cookie sono abilitati
        if (!navigator.cookieEnabled) {
            document.getElementById('cookie-warning').style.display = 'block';
        }
    <?php echo '</script'; ?>
>

    <div class="header-container">

        <!-- Hamburger visibile solo su mobile -->
        <button type='button' class="hamburger" id="hamburger">&#9776;</button>

        <a href="/Delivery/User/home/" class="logo">
            <img src="/Smarty/Immagini/logo.png" alt="Logo">
        </a>

        <div class="nav-links" id="nav-menu">
            <a href="/Delivery/User/home/">Home</a>
            <a href="/Delivery/User/mostraMenu/">Menù</a>
            <?php if ($_smarty_tpl->getValue('role') == "cliente" || !$_smarty_tpl->getValue('logged')) {?>
            <a href="/Delivery/User/order/">Ordina</a>
            <?php }?>
            <?php if ($_smarty_tpl->getValue('logged') && $_smarty_tpl->getValue('role') == "cliente") {?>
                <a href="/Delivery/User/showMyOrders/">I Miei Ordini</a>
            <?php }?>
            <?php if ($_smarty_tpl->getValue('logged') && $_smarty_tpl->getValue('role') == "proprietario") {?>
                <a href="/Delivery/Proprietario/showPanel/">Pannello di Controllo</a>
            <?php }?>
            <?php if ($_smarty_tpl->getValue('logged') && $_smarty_tpl->getValue('role') == "cuoco") {?>
                <a href="/Delivery/Chef/showOrders/">Ordini in Cucina</a>
                <a href="/Delivery/Chef/showOrdiniInAttesa/">Ordini in Attesa</a>
            <?php }?>
            <?php if ($_smarty_tpl->getValue('logged') && $_smarty_tpl->getValue('role') == "rider") {?>
                <a href="/Delivery/Rider/showOrders/">Ordini da Consegnare</a>
            <?php }?>
        </div>
        <div class="user-actions">
            <a href="/Delivery/User/showProfile" title="Profilo">
                <i class="fas fa-user"></i>
            </a>
            <button id="theme-toggle" class="theme-toggle" aria-label="Cambia tema">
                <i class="fas fa-moon"></i>
                <span class="toggle-text">Scuro</span>
            </button>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="/Smarty/Js/hamburger.js" defer><?php echo '</script'; ?>
>
</header>
<?php }
}
