<?php
/* Smarty version 5.5.1, created on 2025-07-06 19:52:58
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_686ab7fa9e9ef1_99912050',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55ae4b4420fd16b87a0b205e02129a0a1c7942d5' => 
    array (
      0 => 'login.tpl',
      1 => 1751469988,
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
function content_686ab7fa9e9ef1_99912050 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nome Ristorante</title>
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

        <!-- Login Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-image">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Login Image">
                </div>
                <div class="login-form">
                    <h1>Accedi al tuo Account</h1>

                    <!-- Error Section -->
                    <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>


                    <form action="/Delivery/User/loginUser" method="POST">
                        <div class="form-group">
                            <label for="username">Nome Utente</label>
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                required
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('username') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                            >
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('password') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                            >
                        </div>
                        <div class="form-group remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe" value="1">
                            <label for="rememberMe">Ricordami</label> <!-- metti qui il metodo per fare il remember -->
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Accedi</button>
                        </div>
                        <div class="form-group">
                            <p>Non hai un account? <a href="/Delivery/User/showRegisterForm">Registrati</a></p>
                        </div>
                        <div class="form-group">
                            <a href="/Delivery/User/forgotPassword">Password dimenticata</a>
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
</html>
<?php }
}
