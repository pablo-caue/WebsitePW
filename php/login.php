<?php 

$SERVER = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "lava_rapido";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli($SERVER, $USER, $PASSWORD, $DB);

    if ($con->connect_error) {
        die("Falha na conexão: " . $con->connect_error);
    }

    $sql = "CALL spPegarCliente(?, ?, @id)";

    $stmt = $con->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $con->error);
    }

    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id);
        $stmt->fetch();

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $id;

        header("Location: ../index.php");
    } else {
        echo "ERRO";
    }


    $stmt->close();
    $con->close();
}
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Signin Template · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="../style/authentification.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../style/login.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal">Faça o login</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
                <label for="email">Endereço de email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                <label for="password">Senha</label>
            </div>

            <div class="text-center my-3">
                <p>Não tem login? <a href="../php/register.php">Cadastre-se</a></p>
            </div>
            <a href="op=login">
            <button class="btn btn-primary w-100 py-2" type="submit">Fazer login</button>
            </a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>

<?php   

$con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);

if (isset($_POST['email']) || isset($_POST['password'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    $sql_code = "CALL spPegarCliente('$email', '$password', @id)";
    $sql_query = $con->query($sql_code) or die("ERRO: " . $con->error);


    $quantidade = $sql_query->num_rows;

    if($quantidade == 1) {

        $id = $sql_query->fetch_assoc();

        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $id['id'];

        header("Location: ../index.php");
    }else{
        echo "ERRO";
    }
}

?>