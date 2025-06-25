<?php
/* Smarty version 5.5.1, created on 2025-06-24 17:44:28
  from 'file:review_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685ac7dc13ac71_53251461',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4433c5e602b833dd85ccd6b33ebb9d7e808a311f' => 
    array (
      0 => 'review_form.tpl',
      1 => 1750602402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685ac7dc13ac71_53251461 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Scrivi una Recensione</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/form.css">
    <link rel="stylesheet" href="/Smarty/css/review.css"> <!-- opzionale -->
</head>
<body>

    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <main>
        <section class="form-section">
            <div class="form-container">
                <h1>Scrivi una Recensione</h1>

                <form method="POST" action="/Delivery/Recensione/writeReview/" class="form">

                    <!-- Descrizione recensione -->
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea id="description" name="description" rows="5" maxlength="1000" placeholder="Scrivi qui la tua recensione..." required></textarea>
                    </div>

                    <!-- Valutazione a stelle -->
                    <div class="form-group">
                        <label for="vote">Valutazione</label>
                        <div class="star-rating">
                            <input type="radio" name="vote" id="star5" value="5"><label for="star5">&#9733;</label>
                            <input type="radio" name="vote" id="star4" value="4"><label for="star4">&#9733;</label>
                            <input type="radio" name="vote" id="star3" value="3"><label for="star3">&#9733;</label>
                            <input type="radio" name="vote" id="star2" value="2"><label for="star2">&#9733;</label>
                            <input type="radio" name="vote" id="star1" value="1"><label for="star1">&#9733;</label>
                        </div>
                    </div>

                    <button type="submit">Invia Recensione</button>

                </form>
            </div>
        </section>
    </main>

    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

</body>
</html>
<?php }
}
