<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $produto = $_POST["produto"];
    $placa_carro = $_POST["placa_carro"];
    $lavagem = $_POST["lavagem"];
    $horario = $_POST["horario"];
    
    $SERVER = "localhost";
    $USER = "root";
    $PASSWORD = "";
    $DB = "lava_rapido";
    
    // Conecte-se ao banco de dados
    
    echo $codigo;
    echo "<br></br>";
    echo $produto;
    echo "<br></br>";
    echo $placa_carro;
    echo "<br></br>";
    echo $lavagem;
    echo "<br></br>";
    echo $horario;
}
?>
