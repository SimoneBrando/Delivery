<?php
/* Smarty version 5.5.1, created on 2025-06-22 11:30:03
  from 'file:account.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6857cd1bd62c38_65582208',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f45da135237bbd958ce3abfce3ac99e643d0fa06' => 
    array (
      0 => 'account.tpl',
      1 => 1750584601,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_6857cd1bd62c38_65582208 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Restaurant - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css"></link>
</head>
<body>
    <!-- Header -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <section class="account-container">
            <h2>Gestione Account</h2>

            <!-- Modifica Profile -->
            <div class="password-section">
                <h3>Modifica Profilo</h3>
                <form action="/Delivery/User/modifyProfile" method="POST">
                    <div class="form-group">
                        <label for="newName">Nuovo Nome</label>
                        <input id="newName" name="newName" value="<?php echo $_smarty_tpl->getValue('utente')->getNome();?>
" required>
                    </div>

                    <div class="form-group">
                        <label for="newSurname">Nuovo Cognome</label>
                        <input id="newSurname" name="newSurname" value="<?php echo $_smarty_tpl->getValue('utente')->getCognome();?>
" required>
                    </div>

                    <button type="submit" class="btn-submit">Aggiorna Profilo</button>
                </form>
            </div>

            <!-- Cambia Password -->
            <div class="password-section">
                <h3>Cambia Password</h3>
                <form action="/Delivery/User/changePassword" method="POST">
                    <div class="form-group">
                        <label for="oldPassword">Vecchia Password</label>
                        <input type="password" id="oldPassword" name="oldPassword" required>
                    </div>

                    <div class="form-group">
                        <label for="newPassword">Nuova Password</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>

                    <button type="submit" class="btn-submit">Aggiorna Password</button>
                </form>
            </div>

            <!-- Sezione Indirizzi -->
            <div class="address-section">
                <h3>I miei indirizzi</h3>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('indirizzi')) > 0) {?>
                    <ul class="address-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('indirizzi'), 'indirizzo');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('indirizzo')->value) {
$foreach0DoElse = false;
?>
                            <li class="address-item">
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo $_smarty_tpl->getValue('indirizzo')->getVia();?>
, <?php echo $_smarty_tpl->getValue('indirizzo')->getCivico();?>
, <?php echo $_smarty_tpl->getValue('indirizzo')->getCap();?>
 <?php echo $_smarty_tpl->getValue('indirizzo')->getCitta();?>

                                </span>
                            </li>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php } else { ?>
                    <p>Nessun indirizzo registrato.</p>
                <?php }?>
                <a href="/Delivery/User/showAddressForm/" class="btn-link">
                    <i class="fas fa-plus"></i> Aggiungi indirizzo
                </a>
            </div>

            <!-- Sezione Carte di Credito -->
            <div class="credit-cards-section">
                <h3>Le mie carte di credito</h3>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('carte_credito')) > 0) {?>
                    <ul class="cards-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('carte_credito'), 'carta');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('carta')->value) {
$foreach1DoElse = false;
?>
                            <li class="card-item">
                                <span>
                                    <i class="far fa-credit-card"></i>
                                    <?php echo $_smarty_tpl->getValue('carta')->getNominativo();?>

                                </span>
                                <form action="/Delivery/User/removeCreditCard" method="POST" class="remove-card-form">
                                    <input type="hidden" name="numero_carta" value="<?php echo $_smarty_tpl->getValue('carta')->getNumeroCarta();?>
">
                                    <button type="submit" class="remove-card-btn" title="Rimuovi Metodo di Pagamento">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </li>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php } else { ?>
                    <p>Nessuna carta di credito registrata.</p>
                <?php }?>
                <a href="/Delivery/User/showCreditCardForm/" class="btn-link">
                    <i class="fas fa-plus"></i> Aggiungi carta
                </a>
            </div>

            <!-- Link ai miei ordini -->
            <div class="orders-link">
                <a href="/Delivery/User/showMyOrders/" class="btn-link">
                    <i class="fas fa-box-open"></i> I miei ordini
                </a>
            </div>

            <!-- Logout -->
            <div class="logout-section">
                <a href="/Delivery/User/logoutUser/" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <a href="/Delivery/User/deleteAccount/" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Delete Account
                </a>
            </div>
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
