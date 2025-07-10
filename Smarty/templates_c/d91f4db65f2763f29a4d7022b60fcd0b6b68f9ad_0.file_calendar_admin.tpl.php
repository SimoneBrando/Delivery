<?php
/* Smarty version 5.5.1, created on 2025-07-10 21:53:29
  from 'file:calendar_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68701a395c90f3_88409104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd91f4db65f2763f29a4d7022b60fcd0b6b68f9ad' => 
    array (
      0 => 'calendar_admin.tpl',
      1 => 1752177199,
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
function content_68701a395c90f3_88409104 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Calendario | Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/admin_calendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php $_smarty_tpl->renderSubTemplate("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <main class="admin-container">
            <div class="calendar-header">
                <a href="javascript:history.back()" class="back-arrow">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
               <h1><i class="fas fa-calendar-alt"></i> Gestione Calendario</h1>
            </div>



       <section class="calendar-section">

       <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <h2><i class="fas fa-clock"></i> Orari Settimanali</h2>

            <table class="calendar-table">
                <thead>
                    <tr>
                        <th>Giorno</th>
                        <th>Apertura</th>
                        <th>Chiusura</th>
                        <th>Stato</th>
                        <th>Azione</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('giorniChiusuraSettimanali'), 'day');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('day')->value) {
$foreach0DoElse = false;
?>
                    <tr>
                        <form method="post" action="/Delivery/Proprietario/editDay">
                            <td><?php echo $_smarty_tpl->getValue('day')->getData();?>
</td>
                            <td>
                                <input type="time" name="orari[apertura]" 
                                    value="<?php if ($_smarty_tpl->getValue('day')->getOrarioApertura() != null) {
echo $_smarty_tpl->getValue('day')->getOrarioApertura()->format('H:i');
}?>">
                            </td>
                            <td>
                                <input type="time" name="orari[chiusura]" 
                                    value="<?php if ($_smarty_tpl->getValue('day')->getOrarioChiusura() != null) {
echo $_smarty_tpl->getValue('day')->getOrarioChiusura()->format('H:i');
}?>">
                            </td>
                            <td>
                                <select name="orari[stato]">
                                    <option value="aperto" <?php if ($_smarty_tpl->getValue('day')->isAperto() == 1) {?>selected<?php }?>>Aperto</option>
                                    <option value="chiuso" <?php if ($_smarty_tpl->getValue('day')->isAperto() == 0) {?>selected<?php }?>>Chiuso</option>
                                </select>
                            </td>
                            <td>
                                <!-- Inviamo anche il giorno per identificare quale aggiornare -->
                                <input type="hidden" name="giorno" value="<?php echo $_smarty_tpl->getValue('day')->getData();?>
">
                                <button type="submit" class="btn-save">Aggiorna</button>
                            </td>
                        </form>
                    </tr>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
        </section>


        <!-- Chiusure Straordinarie -->
        <section class="calendar-section">
            <h2><i class="fas fa-ban"></i> Chiusure Straordinarie</h2>

            <!-- Aggiunta -->
            <form method="post" action="/Delivery/Proprietario/addExceptionDay" class="add-date-form">
                <label for="dataChiusura"><i class="fas fa-plus-circle"></i> Aggiungi data di chiusura:</label>
                <input type="date" name="dataChiusura" required>
                <button type="submit" class="btn-add">Aggiungi</button>
            </form>

            <!-- Elenco -->
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('giorniChiusuraEccezionali')) > 0) {?>
                <table class="calendar-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('giorniChiusuraEccezionali'), 'eccezione');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('eccezione')->value) {
$foreach1DoElse = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->getValue('eccezione')->getExceptionDate()->format('d/m/Y');?>
</td>
                            <td>
                                <form method="post" action="/Delivery/Proprietario/deleteExceptionDay" class="remove-date-form">
                                    <input type="hidden" name="dataChiusura" value="<?php echo $_smarty_tpl->getValue('eccezione')->getExceptionDate()->format('Y-m-d');?>
">
                                    <button type="submit" class="btn-remove"><i class="fas fa-trash-alt"></i> Rimuovi</button>
                                </form>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>

                    </tbody>
                </table>
            <?php } else { ?>
                <p class="no-entries"><i class="fas fa-info-circle"></i> Nessuna chiusura straordinaria impostata.</p>
            <?php }?>
        </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <?php echo '<script'; ?>
 src="/Smarty/Js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/theme.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
