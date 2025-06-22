<?php
/* Smarty version 5.5.1, created on 2025-06-22 16:33:41
  from 'file:address_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685814458c7392_08809121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2502a4887e9fd65a3a0770f3305180dd6386713' => 
    array (
      0 => 'address_form.tpl',
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
function content_685814458c7392_08809121 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Indirizzo</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/form.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main>

        <section class="form-section">

            <div class="form-container">
                <h1>Aggiungi un nuovo indirizzo</h1>

                <!-- Address Form -->
                <form method="POST" action="/Delivery/User/addAddress" class="form">

                    <div class="form-group">
                        <label for="via">Via</label>
                        <input type="text" id="via" name="via" required>
                    </div>

                    <div class="form-group">
                        <label for="civico">Civico</label>
                        <input type="text" id="civico" name="civico" pattern="^[0-9]+[a-zA-Z]?$" required>
                    </div>

                    <div class="form-group">
                        <label for="citta">Città</label>
                        <input type="text" id="citta" name="citta" pattern="^[a-zA-ZÀ-ÿ' ]&#123;2,50&#125;$" title="Solo lettere ammesse" autocapitalize="on" required>
                    </div>

                    <div class="form-group">
                        <label for="cap">CAP</label>
                        <input type="text" id="cap" name="cap" pattern="\d&#123;5&#125;" inputmode="numeric" maxlength="5" title="Inserisci un CAP valido (5 cifre)" required>
                    </div>

                    <button type="submit">Salva Indirizzo</button>

                </form>
            </div>

        </section>

    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

</body>
</html>
<?php }
}
