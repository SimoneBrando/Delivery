<?php
/* Smarty version 5.5.1, created on 2025-06-16 12:08:35
  from 'file:recensioni_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684fed230e0851_32245914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b728e48827e86666346d8d1494450b874303d914' => 
    array (
      0 => 'recensioni_admin.tpl',
      1 => 1750068489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684fed230e0851_32245914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
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
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchReviews" placeholder="Cerca recensioni...">
                </div>
                <div class="filter-group">
                    <label for="filterRating"><i class="fas fa-filter"></i> Filtra per voto:</label>
                    <select id="filterRating">
                        <option value="all">Tutti i voti</option>
                        <option value="5">5 stelle</option>
                        <option value="4">4 stelle</option>
                        <option value="3">3 stelle</option>
                        <option value="2">2 stelle</option>
                        <option value="1">1 stella</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filterDate"><i class="far fa-calendar-alt"></i> Ordina per:</label>
                    <select id="filterDate">
                        <option value="newest">Più recenti</option>
                        <option value="oldest">Più vecchie</option>
                    </select>
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
                                        <span class="review-date"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('review')->getData(),"%d/%m/%Y %H:%M");?>
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
