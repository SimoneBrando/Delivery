<?php
/* Smarty version 5.5.1, created on 2025-07-11 01:43:21
  from 'file:admin_segnalazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687050192a9202_24337134',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b3fcca2d971ec46fd3c36039f0a2471b520e079e' => 
    array (
      0 => 'admin_segnalazioni.tpl',
      1 => 1751894239,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:error_section.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_687050192a9202_24337134 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Recensioni | Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/recensioni.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main class="admin-container">
        <div class="admin-header">
            <a href="/Delivery/Proprietario/showPanel" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1><i class="fas fa-star"></i> Gestione Segnalazioni</h1>
            <p class="admin-subtitle">Visualizza tutte le segnalazioni dei clienti</p>
        </div>
        
        <!-- Filtri e Ricerca -->

            <!-- Error Section -->
            <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        
        <form method="get" action="/Delivery/Proprietario/showSegnalazioni/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="<?php echo htmlspecialchars((string)(($tmp = $_GET['search'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Cerca recensioni...">
                </div>
                <div class="filter-group">
                    <label for="sort"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select name="sort" id="sort">
                        <option value="newest" <?php if (((($tmp = $_GET['sort'] ?? null)===null||$tmp==='' ? 'newest' ?? null : $tmp)) == 'newest' || !$_GET['sort']) {?>selected<?php }?>>Più recenti</option>
                        <option value="oldest" <?php if (((($tmp = $_GET['sort'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'oldest') {?>selected<?php }?>>Più vecchie</option>
                    </select>
                </div>
                <div class="filter-group">
                <button type="submit" class="btn-apply-filters">Applica filtri</button>
            </div>
            </div>
        </section><br>

        <!-- Lista Segnalazioni -->
        <section class="reviews-list">
            <div class="reviews-header">
                <h2><i class="fas fa-list"></i> Tutte le Segnalazioni</h2>
            </div>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('segnalazioni')) > 0) {?>
                <div class="reviews-grid">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('segnalazioni'), 'segnalazione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('segnalazione')->value) {
$foreach0DoElse = false;
?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="user-details">
                                        <h3><?php echo $_smarty_tpl->getValue('segnalazione')->getOrdine()->getCliente()->getNome();?>
 <?php echo $_smarty_tpl->getValue('segnalazione')->getOrdine()->getCliente()->getCognome();?>
 </h3>
                                        <p>Id Ordine: <?php echo $_smarty_tpl->getValue('segnalazione')->getOrdine()->getId();?>
 </p>
                                        <span class="review-date"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('segnalazione')->getData(),"%H:%M %e %B %Y");?>
</span>
                                    </div>
                                </div>
                            </div>
                            <div class="review-content">
                                <p><?php echo $_smarty_tpl->getValue('segnalazione')->getDescrizione();?>
</p>
                            </div>
                        </div>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </div>
            <?php } else { ?>
                <div class="no-reviews">
                    <i class="far fa-frown"></i>
                    <p>Nessuna segnalazione trovata</p>
                </div>
            <?php }?>
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
</body>
</html><?php }
}
