<?php
/* Smarty version 5.5.1, created on 2025-06-10 15:17:44
  from 'file:register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684830784fed23_83697843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db270f8ac0a7c303c09193d152556bd55efa06f7' => 
    array (
      0 => 'register.tpl',
      1 => 1749539856,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_684830784fed23_83697843 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati - Nome Ristorante</title>
    <link rel="stylesheet" href="/Smarty/css/registrati.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <?php echo '<script'; ?>
 src="/Smarty/Js/loadComponents.js" defer><?php echo '</script'; ?>
>
</head>
<body>
    <!-- Header -->
    <div id="header-placeholder"></div>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>HOME RESTAURANT</h1>
                <h2>HOME DELIVERY SERVICE</h2>
            </div>
        </section>

        <!-- Registration Section -->
        <section class="login-section">
            <div class="login-content">
                <div class="login-form">
                    <h1>Registrati</h1>

                    <?php if ((true && ($_smarty_tpl->hasVariable('error') && null !== ($_smarty_tpl->getValue('error') ?? null)))) {?>
                        <div class="error-message"><?php echo $_smarty_tpl->getValue('error');?>
</div>
                    <?php }?>

                    <form action="/Delivery/User/registerUser" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input 
                                type="text" 
                                id="nome" 
                                name="nome" 
                                required 
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('name') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                            >
                        </div>
                        <div class="form-group">
                            <label for="cognome">Cognome</label>
                            <input 
                                type="text" 
                                id="cognome" 
                                name="cognome" 
                                required 
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('cognome') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                            >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required 
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('email') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
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
                            >
                        </div>
                        
                        <div class="form-group">
                            <label for="role">Ruolo</label>
                            <input 
                                type="tel" 
                                id="role" 
                                name="role"  
                                required 
                                value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('phone') ?? null)===null||$tmp==='' ? 'cliente' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                            >
                            <small>Inserisci cliente per prova</small>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn">Registrati</button>
                        </div>
                        <div class="form-group">
                            <p>Sei già registrato? <a href="/Delivery/User/showLoginForm">Accedi</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>

    
    <?php echo '<script'; ?>
>
        document.getElementById('phone').addEventListener('input', function(e) {
            let phoneNumber = e.target.value.replace(/\D/g, ''); // solo numeri
            phoneNumber = phoneNumber.slice(0, 10); // massimo 10 cifre

            if (phoneNumber.length <= 3) {
                e.target.value = phoneNumber;
            } else if (phoneNumber.length <= 6) {
                e.target.value = phoneNumber.replace(/(\d{3})(\d{0,3})/, '$1 $2');
            } else {
                e.target.value = phoneNumber.replace(/(\d{3})(\d{3})(\d{0,4})/, '$1 $2 $3');
            }
        });
    <?php echo '</script'; ?>
>
    

</body>
</html>
<?php }
}
