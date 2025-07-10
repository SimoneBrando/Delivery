<?php
/* Smarty version 5.5.1, created on 2025-07-10 22:07:27
  from 'file:menu_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68701d7f15a693_17455895',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6a38a6c94eec22fec0468fcb995a7a43f6a52f4' => 
    array (
      0 => 'menu_admin.tpl',
      1 => 1752178044,
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
function content_68701d7f15a693_17455895 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\Delivery\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gestione Menu | Home Restaurant</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
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

            <!-- Error Section -->
            <?php $_smarty_tpl->renderSubTemplate("file:error_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        
        <form method="get" action="/Delivery/Proprietario/showMenu/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="<?php echo htmlspecialchars((string)(($tmp = $_GET['search'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"  placeholder="Cerca prodotti...">
                </div>
                <div class="filter-group">
                    <label for="filterCategory"><i class="fas fa-filter"></i> Filtra per categoria:</label>
                    <select name="category" id="filterCategory">
                        <option value="all" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? 'all' ?? null : $tmp)) == 'all') {?>selected<?php }?>>Tutte le categorie</option> 
                        <option value="antipasti" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'antipasti') {?>selected<?php }?>>Antipasti</option> 
                        <option value="primi" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'primi') {?>selected<?php }?>>Primi</option>
                        <option value="secondi" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'secondi') {?>selected<?php }?>>Secondi</option>
                        <option value="dolci" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'dolci') {?>selected<?php }?>>Dolci</option>
                        <option value="bevande" <?php if (((($tmp = $_GET['category'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) == 'bevande') {?>selected<?php }?>>Bevande</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-apply-filters">Applica filtri</button>
                </div>
            </div>
        </section>

        <!-- Lista Prodotti -->
        <section class="products-list">
            <div class="products-header">
                <h2><i class="fas fa-list"></i> Tutti i Prodotti</h2>
            </div>
            
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('products')) > 0) {?>
                <div class="scrollable-table">
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
                            <?php $_smarty_tpl->assign('currentCategory', '', false, NULL);?>
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
                                <?php if ($_smarty_tpl->getValue('currentCategory') != $_smarty_tpl->getValue('product')->getCategoria()->getNome()) {?>
                                    <?php $_smarty_tpl->assign('currentCategory', $_smarty_tpl->getValue('product')->getCategoria()->getNome(), false, NULL);?>
                                    <tr class="category-header">
                                        <td colspan="6"><strong><?php echo $_smarty_tpl->getValue('currentCategory');?>
</strong></td>
                                    </tr>
                                <?php }?>
                                <tr data-id="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                                    <td data-label="ID"><?php echo $_smarty_tpl->getValue('product')->getId();?>
</td>
                                    <td data-label="Nome"><?php echo $_smarty_tpl->getValue('product')->getNome();?>
</td>
                                    <td data-label="Descrizione"><?php echo $_smarty_tpl->getValue('product')->getDescrizione();?>
</td>
                                    <td data-label="Categoria"><?php echo $_smarty_tpl->getValue('product')->getCategoria()->getNome();?>
</td>
                                    <td data-label="Prezzo">€<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->getCosto(),2);?>
</td>
                                    <td class="actions">
                                        <button type="button"
                                                class="btn btn-edit"
                                                data-modal-target="editProductModal"
                                                data-id="<?php echo $_smarty_tpl->getValue('product')->getId();?>
"
                                                data-nome="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
"
                                                data-descrizione="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('product')->getDescrizione(), ENT_QUOTES, 'UTF-8', true);?>
"
                                                data-prezzo="<?php echo $_smarty_tpl->getValue('product')->getCosto();?>
"
                                                data-categoria="<?php echo $_smarty_tpl->getValue('product')->getCategoria()->getId();?>
">
                                            <i class="fas fa-edit"></i> Modifica
                                        </button>
                                        <form action="/Delivery/Proprietario/deleteProduct/" method="post" class="inline-delete-form">
                                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
                                            <button type="submit" class="btn btn-delete" data-product-id="<?php echo $_smarty_tpl->getValue('product')->getId();?>
">
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
                </div>
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
            
            <form id="productForm" action="/Delivery/Proprietario/saveProduct" method="post">
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
                            <option value="1">Antipasti</option>
                            <option value="2">Primi</option>
                            <option value="3">Secondi</option>
                            <option value="4">Dolci</option>
                            <option value="5">Bevande</option>
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

    <!-- Modale per Modifica Prodotto -->
    <div id="editProductModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2><i class="fas fa-pen"></i> Modifica Prodotto</h2>
            <form id="editProductForm" method="post" action="/Delivery/Proprietario/modifyProduct">
                <input type="hidden" name="product_id" id="editProductId">

                <div class="form-group">
                    <label for="editNome">Nome:</label>
                    <input type="text" id="editNome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="editCategoria">Categoria:</label>
                    <select id="editCategoria" name="categoria_id" required>
                        <option value="1">Antipasti</option>
                        <option value="2">Primi</option>
                        <option value="3">Secondi</option>
                        <option value="4">Dolci</option>
                        <option value="5">Bevande</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="editPrezzo">Prezzo (€):</label>
                    <input type="number" id="editPrezzo" name="costo" step="0.01" min="0" required>
                </div>

                <div class="form-group full-width">
                    <label for="editDescrizione">Descrizione:</label>
                    <textarea id="editDescrizione" name="descrizione" rows="3" required></textarea>
                </div>

                <div class="form-group full-width actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salva Modifiche
                    </button>
                </div>
            </form>
        </div>
    </div>



    <?php echo '<script'; ?>
 src="/Smarty/Js/hamburger.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/theme.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Smarty/Js/modal.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-modal-target="editProductModal"]').forEach(button => {
        button.addEventListener('click', function () {
        document.getElementById('editProductId').value = this.dataset.id;
        document.getElementById('editNome').value = this.dataset.nome;
        document.getElementById('editDescrizione').value = this.dataset.descrizione;
        document.getElementById('editCategoria').value = this.dataset.categoria;
        document.getElementById('editPrezzo').value = this.dataset.prezzo;
        });
    });
    });
    <?php echo '</script'; ?>
>

    

</body>
</html><?php }
}
