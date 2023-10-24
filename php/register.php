<?php 
$SERVER = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "lava_rapido";
?>

<!doctype html>
<html lang="pt-br" data-bs-theme="auto">
  <head><script src="../js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Checkout example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    
    <!-- Custom styles for this template -->
    <link href="../style/register.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">
       
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Lava rapido</h2>
    </div>

    <div class="row justify-content-center">
      
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Cadastre-se</h4>
        <form class="needs-validation" method="post" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nome</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required maxlength="16">
              <div class="invalid-feedback">
                Um nome valido e obrigatorio
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Sobrenome</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required maxlength="16">
              <div class="invalid-feedback">
                Um sobrenome valido e obrigatorio
              </div>
            </div>

          
            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="joao@exemplo.com" required maxlength="32">
              <div class="invalid-feedback">
                Insira um email valido
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">CPF <span class="text-body-secondary">(Será usado como login)</span></label>
              <input type="text" class="form-control" id="cpf" name="cpf" placeholder="123.456.789-00" required minlength="11" maxlength="11">
              <div class="invalid-feedback">
                Insira um cpf valido
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Senha</label>
              <input type="password" class="form-control" id="password" name="password" required minlength="8" max="32">
              <div class="invalid-feedback">
                A senha deve ter mais de 8 caracteres
              </div>
            </div>


           
          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Finalizar cadastro</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">&copy; 2017–2023 Company Name</p>
  </footer>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../js/checkout.js"></script></body>
</html>

<?php 

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$password = $_POST['password'];


$con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);

mysqli_query($con, "CALL spIncluiCliente('$firstName', '$lastName', '$email', '$cpf', '$password')");

mysqli_close($con)
?>
