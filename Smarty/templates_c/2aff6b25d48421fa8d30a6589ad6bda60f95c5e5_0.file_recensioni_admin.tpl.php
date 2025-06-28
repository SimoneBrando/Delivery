<?php
/* Smarty version 5.5.1, created on 2025-06-27 18:12:49
  from 'file:recensioni_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ec301932fc1_66115298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2aff6b25d48421fa8d30a6589ad6bda60f95c5e5' => 
    array (
      0 => 'recensioni_admin.tpl',
      1 => 1751039408,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685ec301932fc1_66115298 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Recensioni | Home Restaurant</title>
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
            <h1><i class="fas fa-star"></i> Gestione Recensioni</h1>
            <p class="admin-subtitle">Visualizza e gestisci tutte le recensioni dei clienti</p>
        </div>
        
        <!-- Filtri e Ricerca -->
        <form method="get" action="/Delivery/Proprietario/showReviews/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="<?php echo htmlspecialchars((string)(($tmp = $_GET['search'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Cerca recensioni...">
                </div>
                <div class="filter-group">
                    <label for="stars"><i class="fas fa-filter"></i> Filtra per voto:</label>
                    <select name="stars" id="stars">
                        <option value="all" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? 'all' ?? null : $tmp)) == 'all' || !$_GET['stars']) {?>selected<?php }?>>Tutti i voti</option>
                        <option value="5" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == '5') {?>selected<?php }?>>5 stelle</option>
                        <option value="4" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == '4') {?>selected<?php }?>>4 stelle</option>
                        <option value="3" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == '3') {?>selected<?php }?>>3 stelle</option>
                        <option value="2" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == '2') {?>selected<?php }?>>2 stelle</option>
                        <option value="1" <?php if (((($tmp = $_GET['stars'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == '1') {?>selected<?php }?>>1 stelle</option>
                    </select>
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

        <!-- Lista Recensioni -->
        <section class="reviews-list">
            <div class="reviews-header">
                <h2><i class="fas fa-list"></i> Tutte le Recensioni</h2>
            </div>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('reviews')) > 0) {?>
                <div class="reviews-grid">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('reviews'), 'review');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('review')->value) {
$foreach0DoElse = false;
?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="user-details">
                                        <h3><?php echo $_smarty_tpl->getValue('review')->getCliente()->getNome();?>
 <?php echo $_smarty_tpl->getValue('review')->getCliente()->getCognome();?>
 </h3>
                                        <span class="review-date"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('review')->getData(),"%H:%M %e %B %Y");?>
</span>
                                    </div>
                                </div>
                                <div class="review-rating">
                                    <?php
$_smarty_tpl->assign('i', null);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                                        <?php if ($_smarty_tpl->getValue('i') <= $_smarty_tpl->getValue('review')->getVoto()) {?>
                                            <i class="fas fa-star filled"></i>
                                        <?php } else { ?>
                                            <i class="far fa-star"></i>
                                        <?php }?>
                                    <?php }
}
?>
                                </div>
                            </div>
                            <div class="review-content">
                                <p><?php echo $_smarty_tpl->getValue('review')->getDescrizione();?>
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
                    <p>Nessuna recensione trovata</p>
                </div>
            <?php }?>
        </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>


    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js" defer><?php echo '</script'; ?>
>
</body>
</html><?php }
}
