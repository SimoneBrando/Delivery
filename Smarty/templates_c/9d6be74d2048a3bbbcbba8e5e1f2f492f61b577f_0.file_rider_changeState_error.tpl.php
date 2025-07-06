<?php
/* Smarty version 5.5.1, created on 2025-07-06 19:45:37
  from 'file:rider_changeState_error.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686ab641c9df99_60713673',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d6be74d2048a3bbbcbba8e5e1f2f492f61b577f' => 
    array (
      0 => 'rider_changeState_error.tpl',
      1 => 1751820919,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_686ab641c9df99_60713673 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ordine non disponibile</title>
  <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
  <link rel="stylesheet" href="/Smarty/css/layout.css">
  <link rel="stylesheet" href="/Smarty/css/error.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

  <!-- Header -->
  <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <!-- Main Content -->
  <main>
    <section class="accesso-negato-container">
      <div class="crossed-utensils">
        <i class="fas fa-triangle-exclamation fork"></i>
      </div>

      <h1>Ordine già preso in carico</h1>
      <p>Questo ordine è già stato modificato da un altro rider.</p>
      <p>Ti invitiamo a selezionare un altro ordine tra quelli ancora disponibili.</p>
      <a class="button" href="/Delivery/Rider/showOrders/">Torna agli ordini</a>
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
</html>
<?php }
}
