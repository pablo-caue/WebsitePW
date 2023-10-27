<?php
if (!isset($_SESSION)) {
    session_start();
}

$SERVER = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "lava_rapido";

$con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);

if (
    isset($_POST['marca']) ||
    isset($_POST['modelo']) ||
    isset($_POST['cor']) ||
    isset($_POST['ano']) ||
    isset($_POST['tipo_veiculo']) ||
    isset($_POST['placa_carro']) ||
    isset($_POST['funcionario']) ||
    isset($_POST['horario']) ||
    isset($_POST['tipo_lavagem']) ||
    isset($_POST['produto'])
) {
    $marca = $con->real_escape_string($_POST['marca']);
    $modelo = $con->real_escape_string($_POST['modelo']);
    $cor = $con->real_escape_string($_POST['cor']);
    $ano = $con->real_escape_string($_POST['ano']);
    $tipo_veiculo = $con->real_escape_string($_POST['tipo_veiculo']);
    $placa_carro = $con->real_escape_string($_POST['placa_carro']);

    // Primeira consulta
    $sql_code = "CALL spIncluiVeiculo('$marca', '$modelo', '$cor', '$ano', '$tipo_veiculo', '$placa_carro')";
    $sql_query1 = $con->query($sql_code) or die("ERRO: " . $con->error);

    $placa_carro_lista = $sql_query1->fetch_assoc();
    $placa_carro = $placa_carro_lista['placa'];

    // Feche a conexão após a primeira consulta
    $con->close();

    // Reabra a conexão para a segunda consulta
    $con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);

    $id_cliente = $_SESSION['id'];
    $cpf_funcionario = $con->real_escape_string($_POST['funcionario']);
    $horario = $con->real_escape_string($_POST['horario']);
    $tipo_lavagem = $con->real_escape_string($_POST['tipo_lavagem']);
    $idProduto = $con->real_escape_string($_POST['produto']);

    // Segunda consulta
    $sql_code = "CALL spIncluiAgendamento('$idProduto', '$cpf_funcionario', '$id_cliente', '$placa_carro', '$tipo_lavagem', '$horario')";
    $sql_query2 = $con->query($sql_code) or die("ERRO: " . $con->error);

    $con->close();

    header("Location: ../index.php");
    exit();
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
    <title>Checkout example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="../style/scheduling.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Lava rapido</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Agendamento</h4>
                    <form class="needs-validation" method="post" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" placeholder="" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Insira uma marca valida
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" placeholder=""
                                    value="" required>
                                <div class="invalid-feedback">
                                    Insira um modelo de carro valido
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <label for="cor" class="form-label">Cor</label>
                                <input type="text" class="form-control" id="cor" name="cor" placeholder="" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Insira uma cor valida
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" class="form-control" id="ano" name="ano" placeholder="" value=""
                                    required>
                                <div class="invalid-feedback">
                                    Insira um ano valido
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="country" class="form-label">Tipo de veiculo</label>
                                <select class="form-select" id="tipo_veiculo" name="tipo_veiculo" required>
                                    <option value="">Escolha...</option>
                                    <option>Motocicleta R$5</option>
                                    <option>Veiculo pequeno R$7,50</option>
                                    <option>Veiculo medio R$10</option>
                                    <option>Caminhonete R$12</option>
                                    <option>Van R$14</option>
                                    <option>Grande Porte R$15</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um tipo de veiculo
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <label for="lastName" class="form-label">Placa do carro</label>
                                <input type="" class="form-control" id="placa_carro" name="placa_carro" placeholder=""
                                    value="" required>
                                <div class="invalid-feedback">
                                    Placa invalida
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label for="funcionario" class="form-label">Funcionario</label>
                                <select class="form-select" id="funcionario" name="funcionario" required>
                                    <option value="">Escolha...</option>
                                    <?php

                                    $sql_code = "SELECT * FROM vPegarFuncionario";
                                    $result = $con->query($sql_code) or die("ERRO: " . $con->error);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["cpf"] . '">' . $row["nome"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um funcionario
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="ano" class="form-label">Horario</label>
                                <input type="time" class="form-control" id="horario" name="horario" placeholder=""
                                    value="" required>
                                <div class="invalid-feedback">
                                    Insira um horario valido
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="country" class="form-label">Tipo de lavagem</label>
                                <select class="form-select" id="tipo_lavagem" name="tipo_lavagem" required>
                                    <option value="">Escolha...</option>
                                    <?php

                                    $sql_code_lavagem = "SELECT * FROM vPegarTipoLavagem";
                                    $result = $con->query($sql_code_lavagem) or die("ERRO: " . $con->error);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["tipo_lavagem"] . ' R$' . $row["valor"] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um funcionario
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="state" class="form-label">Produto</label>
                                <select class="form-select" id="produto" name="produto" required>
                                    <option value="">Escolha...</option>
                                    <?php

                                    $sql_code_lavagem = "SELECT * FROM vPegarProduto";
                                    $result = $con->query($sql_code_lavagem) or die("ERRO: " . $con->error);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["id"] . '">' . $row["nome"] . ' - ' . $row["marca"] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um produto
                                </div>
                            </div>

                        </div>
                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Fechar
                            agendamento</button>

                    </form>


                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-body-secondary text-center text-small">
            <p class="mb-1">&copy; 2017–2023 Company Name</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="checkout.js"></script>
</body>

</html>
