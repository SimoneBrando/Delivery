<?php
/* Smarty version 5.5.1, created on 2025-06-16 13:16:41
  from 'file:create_profile_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684ffd19251235_29830611',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b30a38074d4fd4db872fd236d518678901787bc9' => 
    array (
      0 => 'create_profile_admin.tpl',
      1 => 1750072459,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684ffd19251235_29830611 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crea Account Collaboratore</title>
  <link rel="stylesheet" href="/Smarty/css/create_profile_admin.css" />
  <link rel="stylesheet" href="/Smarty/css/layout.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>

  <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

  <main>
    <section class="account-create-container">
      <h2>Crea un nuovo account</h2>

      <form action="/Delivery/Proprietario/createCollaboratore" method="POST">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
          <label for="cognome">Cognome</label>
          <input type="text" id="cognome" name="cognome" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
          <label for="ruolo">Ruolo</label>
          <select id="ruolo" name="ruolo" required>
            <option value="">-- Seleziona un ruolo --</option>
            <option value="chef">Chef</option>
            <option value="rider">Rider</option>
          </select>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fas fa-user-plus"></i> Crea Account
        </button>
      </form>
    </section>
  </main>

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
