<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Metodo di Pagamento</title>
    <link rel="stylesheet" href="/Smarty/css/layout.css">
    <link rel="stylesheet" href="/Smarty/css/form.css">
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
                        <input type="text" id="numero_carta" name="numero_carta" required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" required>
                    </div>

                    <div class="form-group">
                        <label for="nome_intestatario">Nome Intestatario</label>
                        <input type="text" id="nome_intestatario" name="nome_intestatario" required>
                    </div>

                    <div class="form-group">
                        <label for="data_scadenza">Data Scadenza</label>
                        <input type="text" id="data_scadenza" name="data_scadenza" pattern="^(0[1-9]|1[0-2])\/\d{2}$" required>
                    </div>

                    <button type="submit">Salva Indirizzo</button>

                </form>
            </div>

        </section>

    </main>

    <!-- Footer -->
    {include file="footer.tpl"}

</body>
</html>