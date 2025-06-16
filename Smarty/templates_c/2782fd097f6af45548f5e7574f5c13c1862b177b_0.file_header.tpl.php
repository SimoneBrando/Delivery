<?php
/* Smarty version 5.5.1, created on 2025-06-16 10:46:04
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684fd9cc259d26_28177693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2782fd097f6af45548f5e7574f5c13c1862b177b' => 
    array (
      0 => 'header.tpl',
      1 => 1750063531,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684fd9cc259d26_28177693 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><header>
    <div class="header-container">

        <!-- Hamburger visibile solo su mobile -->
        <button type='button' class="hamburger" id="hamburger">&#9776;</button>

        <a href="/Delivery/User/home/" class="logo">
            <img src="/Smarty/Immagini/logo.png" alt="Logo">
        </a>

        <div class="nav-links" id="nav-menu">
            <a href="/Delivery/User/home/">Home</a>
            <a href="/Delivery/User/mostraMenu/">Menù</a>
            <a href="/Delivery/User/order/">Ordina</a>
            <?php if ($_smarty_tpl->getValue('logged')) {?>
                <a href="/Delivery/User/showMyOrders/">I Miei Ordini</a>
            <?php }?>
        </div>

        <div class="user-actions">
            <a href="admin_panel.html" title="Notifiche">
                <i class="fas fa-bell"></i>
            </a>
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
