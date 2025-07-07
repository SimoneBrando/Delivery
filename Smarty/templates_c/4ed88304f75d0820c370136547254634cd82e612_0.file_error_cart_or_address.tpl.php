<?php
/* Smarty version 5.5.1, created on 2025-07-07 16:30:53
  from 'file:error_cart_or_address.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686bda1db6c358_32674164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ed88304f75d0820c370136547254634cd82e612' => 
    array (
      0 => 'error_cart_or_address.tpl',
      1 => 1751898648,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_686bda1db6c358_32674164 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informazioni mancanti</title>
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
        <i class="fas fa-exclamation-triangle fork"></i>
      </div>

      <h1>Informazioni mancanti</h1>
      <p>Per completare l’ordine è necessario selezionare un indirizzo di consegna e un metodo di pagamento.</p>
      <p>Ti invitiamo a fornire queste informazioni per proseguire con l’ordine.</p>
      <a class="button" href="/Delivery/Ordine/showConfirmOrder/">Torna alla pagina Ordina</a>
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
</html>
<?php }
}
