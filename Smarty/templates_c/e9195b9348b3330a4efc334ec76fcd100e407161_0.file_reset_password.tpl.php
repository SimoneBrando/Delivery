<?php
/* Smarty version 5.5.1, created on 2025-07-10 21:13:20
  from 'file:reset_password.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_687010d06e4237_61528702',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9195b9348b3330a4efc334ec76fcd100e407161' => 
    array (
      0 => 'reset_password.tpl',
      1 => 1752158000,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:error_section.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_687010d06e4237_61528702 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera Password - Nome Ristorante</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Section -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <!-- Recupero Password Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-image">
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Recupero Password">
                </div>
                <div class="login-form">
                    <h1>Recupera la tua Password</h1>

                    <!-- Error Section -->
                    <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

                    <form action="/Delivery/User/resetPassword" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="selector" value=<?php echo $_smarty_tpl->getValue('selector');?>
>
                            <input type="hidden" name="token" value=<?php echo $_smarty_tpl->getValue('token');?>
>
                            <label>Nuova Password:</label>
                            <input type="password" name="password" required placeholder="Nuova Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Modifica Password</button>
                        </div>
                    </form>
                </div>
            </div>
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
</html><?php }
}
