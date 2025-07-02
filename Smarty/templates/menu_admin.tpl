<!DOCTYPE html>
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
    {include file="header.tpl"}

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
            {include file="error_section.tpl"}
        
        <form method="get" action="/Delivery/Proprietario/showMenu/">
        <section class="filters-section">
            <div class="filters-grid">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{$smarty.get.search|default:''|escape}"  placeholder="Cerca prodotti...">
                </div>
                <div class="filter-group">
                    <label for="filterCategory"><i class="fas fa-filter"></i> Filtra per categoria:</label>
                    <select name="category" id="filterCategory">
                        <option value="all" {if ($smarty.get.category|default:'all') == 'all'}selected{/if}>Tutte le categorie</option> 
                        <option value="antipasti" {if ($smarty.get.category|default:'') == 'antipasti'}selected{/if}>Antipasti</option> 
                        <option value="primi" {if ($smarty.get.category|default:'') == 'primi'}selected{/if}>Primi</option>
                        <option value="secondi" {if ($smarty.get.category|default:'') == 'secondi'}selected{/if}>Secondi</option>
                        <option value="dolci" {if ($smarty.get.category|default:'') == 'dolci'}selected{/if}>Dolci</option>
                        <option value="bevande" {if ($smarty.get.category|default:'') == 'bevande'}selected{/if}>Bevande</option>
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
            
            {if $products|@count > 0}
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
                        {foreach from=$products item=product}
                            <tr data-id="{$product->getId()}">
                                <td data-label="ID">{$product->getId()}</td>
                                <td data-label="Nome">{$product->getNome()}</td>
                                <td data-label="Descrizione">{$product->getDescrizione()}</td>
                                <td data-label="Categoria">{$product->getCategoria()->getNome()}</td>
                                <td data-label="Prezzo">€{$product->getCosto()|number_format:2}</td>
                                <td class="actions">
                                    <button type="button"
                                            class="btn btn-edit"
                                            data-modal-target="editProductModal"
                                            data-id="{$product->getId()}"
                                            data-nome="{$product->getNome()|escape:'html'}"
                                            data-descrizione="{$product->getDescrizione()|escape:'html'}"
                                            data-prezzo="{$product->getCosto()}"
                                            data-categoria="{$product->getCategoria()->getId()}">
                                        <i class="fas fa-edit"></i> Modifica
                                    </button>
                                    <form action="/Delivery/Proprietario/deleteProduct/" method="post" class="inline-delete-form">
                                        <input type="hidden" name="product_id" value="{$product->getId()}">
                                        <button type="submit" class="btn btn-delete" data-product-id="{$product->getId()}">
                                            <i class="fas fa-trash-alt"></i> Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else}
                <div class="no-products">
                    <i class="far fa-frown"></i>
                    <p>Nessun prodotto trovato</p>
                </div>
            {/if}
        </section>

        <!-- Form Aggiungi Prodotto -->
        <section class="product-form-section">
            <h2><i class="fas fa-plus-circle"></i> Aggiungi Prodotto</h2>
            
            <form id="productForm" action="/Delivery/Proprietario/saveProduct" method="post">
                {if $editMode}
                    <input type="hidden" name="product_id" value="{$editingProduct->getId()}">
                {/if}
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="productName">Nome:</label>
                        <input type="text" id="productName" name="nome" value="{if $editMode}{$editingProduct->getNome()}{/if}" required>
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
                        <input type="number" id="productPrice" name="costo" step="0.01" min="0" value="{if $editMode}{$editingProduct->getCosto()}{/if}" required>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="productDescription">Descrizione:</label>
                        <textarea id="productDescription" name="descrizione" rows="3" required>{if $editMode}{$editingProduct->getDescrizione()}{/if}</textarea>
                    </div>
                    
                    <div class="form-group full-width actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {if $editMode}Salva Modifiche{else}Aggiungi Prodotto{/if}
                        </button>
                        
                        {if $editMode}
                            <a href="/Delivery/Proprietario/gestioneMenu" class="btn btn-cancel">
                                <i class="fas fa-times"></i> Annulla
                            </a>
                        {/if}
                    </div>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

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



    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js"></script>
    <script src="/Smarty/Js/modal.js"></script>
    <script>
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
    </script>

    

</body>
</html>