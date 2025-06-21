<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuovo Indirizzo</title>
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
                <h1>Aggiungi un nuovo indirizzo</h1>

                <!-- Address Form -->
                <form method="POST" action="/Delivery/User/addAddress" class="form">

                    <div class="form-group">
                        <label for="via">Via</label>
                        <input type="text" id="via" name="via" required>
                    </div>

                    <div class="form-group">
                        <label for="civico">Civico</label>
                        <input type="text" id="civico" name="civico" required>
                    </div>

                    <div class="form-group">
                        <label for="citta">Città</label>
                        <input type="text" id="citta" name="citta" required>
                    </div>

                    <div class="form-group">
                        <label for="cap">CAP</label>
                        <input type="text" id="cap" name="cap" pattern="\d{5}" required>
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
