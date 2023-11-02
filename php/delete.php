<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $codigo = $_POST["codigo"];
  
  $SERVER = "localhost";
  $USER = "root";
  $PASSWORD = "";
  $DB = "lava_rapido";
  
  // Conecte-se ao banco de dados
  $con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);
  
  if (!$con) {
    die("Falha na conexão: " . mysqli_connect_error());
  }
  
  // Execute a chamada para a procedure
  $sql = "CALL spDeletarAgendamentoPeloId($codigo)";
  if ($con->query($sql) === TRUE) {
    // Agendamento excluído com sucesso
    echo '<script>alert("Exclusão bem-sucedida!");</script>';
    echo '<script>window.location.href = "../index.php";</script>';
  } else {
    // Falha na execução da procedure
    echo "Erro ao excluir o agendamento: " . $con->error;
  }

  // Fechar a conexão
  mysqli_close($con);
}
?>
