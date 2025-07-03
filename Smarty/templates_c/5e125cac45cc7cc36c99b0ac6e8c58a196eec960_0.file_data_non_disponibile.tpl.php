<?php
/* Smarty version 5.5.1, created on 2025-07-03 17:50:08
  from 'file:data_non_disponibile.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6866a6b06fa228_75031755',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e125cac45cc7cc36c99b0ac6e8c58a196eec960' => 
    array (
      0 => 'data_non_disponibile.tpl',
      1 => 1751557795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6866a6b06fa228_75031755 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data non disponibile</title>
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
        <i class="fas fa-calendar-times fork"></i>
      </div>

      <h1>Data non disponibile</h1>
      <p>La data o l'orario da te selezionati non sono disponibili perché il ristorante è chiuso.</p>
      <p>Ti invitiamo a scegliere un'altra data o orario tra quelli disponibili.</p>
      <a class="button" href="/Delivery/User/order/">Torna alla pagina Ordina</a>
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
