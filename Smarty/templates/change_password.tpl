<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      padding: 50px;
    }
    .form-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 15px;
    }
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button[type="submit"] {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Reset Password</h2>
    <form action="/Delivery/User/changePassword" method="POST">
      <label for="oldPassword">Vecchia Password</label>
      <input type="password" id="oldPassword" name="oldPassword" required>

      <label for="newPassword">Nuova Password</label>
      <input type="password" id="newPassword" name="newPassword" required>

      <button type="submit">Cambia Password</button>
    </form>
  </div>
</body>
</html>
