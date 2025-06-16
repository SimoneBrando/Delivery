<?php
/* Smarty version 5.5.1, created on 2025-06-16 12:31:06
  from 'file:menu_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_684ff26add2de6_10499798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6421f281eeaa0366aa28bd5e8c170491429780dd' => 
    array (
      0 => 'menu_admin.tpl',
      1 => 1750069864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
))) {
function content_684ff26add2de6_10499798 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Applications/XAMPP/xamppfiles/htdocs/Delivery/Smarty/templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gestione Menu | Home Restaurant</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/menu_admin.css">
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
            <h1><i class="fas fa-utensils"></i> Gestione Menu</h1>
            <p class="admin-subtitle">Gestisci tutti i prodotti del tuo menu</p>
        </div>
        
        <!-- Filtri e Ricerca -->
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchProducts" placeholder="Cerca prodotti...">
                </div>
                <div class="filter-group">
                    <label for="filterCategory"><i class="fas fa-filter"></i> Filtra per categoria:</label>
                    <select id="filterCategory">
                        <option value="all">Tutte le categorie</option> 
                        <option value="antipasti">Antipasti</option> 
                        <option value="primi">Primi</option>
                        <option value="secondi">Secondi</option>
                        <option value="dolci">Dolci</option>
                        <option value="bevande">Bevande</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Lista Prodotti -->
        <section class="products-list">
            <div class="products-header">
                <h2><i class="fas fa-list"></i> Tutti i Prodotti</h2>
            </div>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('products')) > 0) {?>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrizione</th>
                            <th>Categoria</th>
                            <th>Prezzo</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
                            <tr data-id="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                                <td><?php echo $_smarty_tpl->getValue('product')->getId();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('product')->getNome();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('product')->getDescrizione();?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('product')->getCategoria()->getNome();?>
</td>
                                <td>€<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getCosto(),2);?>
</td>
                                <td class="actions">
                                    <button class="btn btn-edit" data-id="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                                        <i class="fas fa-edit"></i> Modifica
                                    </button>
                                    <form action="/Delivery/Proprietario/METODOELIMINAPRODOTTO" method="post" class="inline-delete-form">
                                        <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getId();?>
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
                <div class="no-products">
                    <i class="far fa-frown"></i>
                    <p>Nessun prodotto trovato</p>
                </div>
            <?php }?>
        </section>

        <!-- Form Aggiungi Prodotto -->
        <section class="product-form-section">
            <h2><i class="fas fa-plus-circle"></i> Aggiungi Prodotto</h2>
            
            <form id="productForm" action="/Delivery/Proprietario/NOMEDELMETODOPERAGGIUNGEREUNPRODOTTO" method="post">
                <?php if ($_smarty_tpl->getValue('editMode')) {?>
                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('editingProduct')->getId();?>
">
                <?php }?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="productName">Nome:</label>
                        <input type="text" id="productName" name="nome" value="<?php if ($_smarty_tpl->getValue('editMode')) {
echo $_smarty_tpl->getValue('editingProduct')->getNome();
}?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="productCategory">Categoria:</label>
                        <select id="productCategory" name="categoria_id" required>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach1DoElse = false;
?>
                                <option value="<?php echo $_smarty_tpl->getValue('category')->getId();?>
" <?php if ($_smarty_tpl->getValue('editMode') && $_smarty_tpl->getValue('editingProduct')->getCategoria()->getId() == $_smarty_tpl->getValue('category')->getId()) {?>selected<?php }?>>
                                    <?php echo $_smarty_tpl->getValue('category')->getNome();?>

                                </option>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="productPrice">Prezzo (€):</label>
                        <input type="number" id="productPrice" name="costo" step="0.01" min="0" value="<?php if ($_smarty_tpl->getValue('editMode')) {
echo $_smarty_tpl->getValue('editingProduct')->getCosto();
}?>" required>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="productDescription">Descrizione:</label>
                        <textarea id="productDescription" name="descrizione" rows="3" required><?php if ($_smarty_tpl->getValue('editMode')) {
echo $_smarty_tpl->getValue('editingProduct')->getDescrizione();
}?></textarea>
                    </div>
                    
                    <div class="form-group full-width actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php if ($_smarty_tpl->getValue('editMode')) {?>Salva Modifiche<?php } else { ?>Aggiungi Prodotto<?php }?>
                        </button>
                        
                        <?php if ($_smarty_tpl->getValue('editMode')) {?>
                            <a href="/Delivery/Proprietario/gestioneMenu" class="btn btn-cancel">
                                <i class="fas fa-times"></i> Annulla
                            </a>
                        <?php }?>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <?php $_smarty_tpl->renderSubTemplate("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <!-- Modal Conferma Eliminazione -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2><i class="fas fa-exclamation-triangle"></i> Conferma Eliminazione</h2>
            <p>Sei sicuro di voler eliminare questo prodotto?</p>
            <div class="modal-actions">
                <button id="confirmDelete" class="btn btn-danger">Elimina</button>
                <button id="cancelDelete" class="btn btn-secondary">Annulla</button>
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
 src="/Smarty/js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/js/theme.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
