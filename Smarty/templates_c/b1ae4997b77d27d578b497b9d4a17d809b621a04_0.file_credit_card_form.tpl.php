<?php
/* Smarty version 5.5.1, created on 2025-06-22 00:28:41
  from 'file:credit_card_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6857321944b440_18269142',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1ae4997b77d27d578b497b9d4a17d809b621a04' => 
    array (
      0 => 'credit_card_form.tpl',
      1 => 1750544918,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6857321944b440_18269142 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Metodo di Pagamento</title>
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
                <h1>Aggiungi un nuovo metodo di pagamento</h1>

                <!-- CreditCard Form -->
                <form method="POST" action="/Delivery/User/addCreditCard" class="form">

                    <div class="form-group">
                        <label for="nome_carta">Nominativo Carta</label>
                        <input type="text" id="nome_carta" name="nome_carta" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_carta">Numero Carta</label>
                        <input type="text" id="numero_carta" name="numero_carta" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>

                    <div class="form-group">
                        <label for="nome_intestatario">Nome Intestatario</label>
                        <input type="text" id="nome_intestatario" name="nome_intestatario" required>
                    </div>

                    <div class="form-group">
                        <label for="data_scadenza">Data Scadenza</label>
                        <input type="text" id="data_scadenza" name="data_scadenza" pattern="^(0[1-9]|1[0-2])\/\d<?php echo 2;?>
$" required>
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
</html><?php }
}
