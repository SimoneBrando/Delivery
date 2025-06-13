<?php
/* Smarty version 5.5.1, created on 2025-06-13 12:02:13
  from 'file:account.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684bf7250594b8_12906607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82ab34eed0b4d298bd19deda8b1c83a45698cd15' => 
    array (
      0 => 'account.tpl',
      1 => 1749808457,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684bf7250594b8_12906607 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
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
            </div>
        </section>

    </main>

    <!-- Footer -->
    
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    
</body>

</html><?php }
}
