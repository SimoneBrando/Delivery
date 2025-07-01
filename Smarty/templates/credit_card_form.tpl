<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Metodo di Pagamento</title>
    <link rel="icon" type="image/x-icon" href="/Smarty/Immagini/favicon.ico">
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    {include file="header.tpl"}

    <!-- Main Content -->
    <main>

        <section class="form-section">

            <div class="form-container">
                <h1>Aggiungi un nuovo metodo di pagamento</h1>

                <!-- CreditCard Form -->
                <form method="POST" action="/Delivery/User/addCreditCard" class="form">

                    <div class="form-group">
                        <label for="nome_carta">Nominativo Carta</label>
                        <input type="text" id="nome_carta" name="nome_carta" required>
                    </div>

                    <div class="form-group">
                        <label for="numero_carta">Numero Carta</label>
                        <input type="text" id="numero_carta" name="numero_carta" pattern="^\d&#123;16&#125;$" inputmode="numeric" maxlength="16" title="Inserisci 16 cifre numeriche" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" pattern="^\d&#123;3,4&#125;$" inputmode="numeric" maxlength="4" title="Inserisci un CVV di 3 o 4 cifre" required>
                    </div>

                    <div class="form-group">
                        <label for="nome_intestatario">Nome Intestatario</label>
                        <input type="text" id="nome_intestatario" name="nome_intestatario" pattern="^[a-zA-ZÀ-ÿ' ]&#123;2,50&#125;$" title="Inserisci un nome valido (solo lettere e spazi)" required>
                    </div>

                    <div class="form-group">
                        <label for="data_scadenza">Data Scadenza</label>
                        <input type="text" id="data_scadenza" name="data_scadenza" pattern="^(0[1-9]|1[0-2])\/\d&#123;2&#125;$" inputmode="numeric" placeholder="MM/AA" required>
                    </div>

                    <button type="submit">Salva Metodo di Pagamento</button>

                </form>
            </div>

        </section>

    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

</body>
</html>