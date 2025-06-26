<?php
/* Smarty version 5.5.1, created on 2025-06-25 17:55:54
  from 'file:create_account_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_685c1c0aa9a5f0_15225174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bb7c659ad81063221017a799bcb607577281cc3' => 
    array (
      0 => 'create_account_admin.tpl',
      1 => 1750607834,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_685c1c0aa9a5f0_15225174 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Account Collaboratore | Admin Panel</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/create_account_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Main Content -->
    <main class="admin-container">
        <div class="admin-header">
            <a href="/Delivery/Proprietario/showPanel" class="back-button">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1><i class="fas fa-user-plus"></i> Crea Nuovo Account</h1>
            <p class="admin-subtitle">Aggiungi un nuovo collaboratore al tuo team</p>
        </div>

        <section class="form-container">
            <div class="form-card">
                <form action="/Delivery/Proprietario/createEmployee" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nome">
                                <i class="fas fa-user"></i> Nome
                            </label>
                            <input type="text" id="nome" name="nome" placeholder="Mario" required>
                        </div>

                        <div class="form-group">
                            <label for="cognome">
                                <i class="fas fa-user"></i> Cognome
                            </label>
                            <input type="text" id="cognome" name="cognome" placeholder="Rossi" required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input type="email" id="email" name="email" placeholder="mario.rossi@example.com" required>
                        </div>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <div class="password-input">
                                <input type="password" id="password" name="password" required>
                                <button type="button" class="toggle-password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ruolo">
                                <i class="fas fa-user-tag"></i> Ruolo
                            </label>
                            <select id="ruolo" name="ruolo" required>
                                <option value="">-- Seleziona un ruolo --</option>
                                <option value="Cuoco">Cuoco</option>
                                <option value="Rider">Rider</option>
                            </select>
                        </div>

                        <div class="form-group full-width">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Crea Account
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Lista Collaboratori -->
        <section class="collaborators-list">
            <!-- Sezione Chef -->
            <div class="role-section">
                <h2><i class="fas fa-utensils"></i> Chef</h2>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('chefs')) > 0) {?>
                    <table class="collaborators-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('chefs'), 'chef');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('chef')->value) {
$foreach0DoElse = false;
?>
                                <tr data-id="<?php echo $_smarty_tpl->getValue('chef')->getId();?>
">
                                    <td><?php echo $_smarty_tpl->getValue('chef')->getNome();?>
 <?php echo $_smarty_tpl->getValue('chef')->getCognome();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('chef')->getEmail();?>
</td>
                                    <td class="actions">
                                        <button class="btn btn-edit" data-id="<?php echo $_smarty_tpl->getValue('chef')->getId();?>
">
                                            <i class="fas fa-edit"></i> Modifica
                                        </button>
                                        <form action="/Delivery/Proprietario/deleteEmployee" method="POST" class="inline-form">
                                            <input type="hidden" name="employeeId" value="<?php echo $_smarty_tpl->getValue('chef')->getUserId();?>
">
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash-alt"></i> Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="no-collaborators">
                        <i class="fas fa-info-circle"></i>
                        <p>Nessuno chef registrato</p>
                    </div>
                <?php }?>
            </div>

            <!-- Sezione Rider -->
            <div class="role-section">
                <h2><i class="fas fa-motorcycle"></i> Rider</h2>
                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('riders')) > 0) {?>
                    <table class="collaborators-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('riders'), 'rider');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rider')->value) {
$foreach1DoElse = false;
?>
                                <tr data-id="<?php echo $_smarty_tpl->getValue('rider')->getId();?>
">
                                    <td><?php echo $_smarty_tpl->getValue('rider')->getNome();?>
 <?php echo $_smarty_tpl->getValue('rider')->getCognome();?>
</td>
                                    <td><?php echo $_smarty_tpl->getValue('rider')->getEmail();?>
</td>
                                    <td class="actions">
                                        <button class="btn btn-edit" data-id="<?php echo $_smarty_tpl->getValue('rider')->getId();?>
">
                                            <i class="fas fa-edit"></i> Modifica
                                        </button>
                                        <form action="/Delivery/Proprietario/deleteEmployee" method="POST" class="inline-form">
                                            <input type="hidden" name="employeeId" value="<?php echo $_smarty_tpl->getValue('rider')->getUserId();?>
">
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash-alt"></i> Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="no-collaborators">
                        <i class="fas fa-info-circle"></i>
                        <p>Nessun rider registrato</p>
                    </div>
                <?php }?>
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
 src="/Smarty/js/theme.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
