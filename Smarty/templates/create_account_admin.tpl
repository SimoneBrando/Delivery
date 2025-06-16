<!DOCTYPE html>
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
    {include file="header.tpl"}

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
                {if $chefs|@count > 0}
                    <table class="collaborators-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$chefs item=chef}
                                <tr data-id="{$chef->getId()}">
                                    <td>{$chef->getNome()} {$chef->getCognome()}</td>
                                    <td>{$chef->getEmail()}</td>
                                    <td class="actions">
                                        <button class="btn btn-edit" data-id="{$chef->getId()}">
                                            <i class="fas fa-edit"></i> Modifica
                                        </button>
                                        <form action="/Delivery/Proprietario/METODOELIMINAPERSONALE" method="POST" class="inline-form">
                                            <input type="hidden" name="user_id" value="{$chef->getId()}">
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash-alt"></i> Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else}
                    <div class="no-collaborators">
                        <i class="fas fa-info-circle"></i>
                        <p>Nessuno chef registrato</p>
                    </div>
                {/if}
            </div>

            <!-- Sezione Rider -->
            <div class="role-section">
                <h2><i class="fas fa-motorcycle"></i> Rider</h2>
                {if $riders|@count > 0}
                    <table class="collaborators-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$riders item=rider}
                                <tr data-id="{$rider->getId()}">
                                    <td>{$rider->getNome()} {$rider->getCognome()}</td>
                                    <td>{$rider->getEmail()}</td>
                                    <td class="actions">
                                        <button class="btn btn-edit" data-id="{$rider->getId()}">
                                            <i class="fas fa-edit"></i> Modifica
                                        </button>
                                        <form action="/Delivery/Proprietario/deleteCollaboratore" method="POST" class="inline-form">
                                            <input type="hidden" name="user_id" value="{$rider->getId()}">
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash-alt"></i> Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else}
                    <div class="no-collaborators">
                        <i class="fas fa-info-circle"></i>
                        <p>Nessun rider registrato</p>
                    </div>
                {/if}
            </div>
        </section>
    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

    <script src="/Smarty/js/hamburger.js"></script>
    <script src="/Smarty/js/theme.js"></script>
</body>
</html>