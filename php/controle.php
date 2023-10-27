<?php
/*
Antes de acessar, execute os comandos do arquivo bsaude.sql
*/
$SERVIDOR = "localhost";
$USUARIO = "root";
$SENHA = "";
$BASE = "lava_rapido";

/* O comando if (isset($_GET['op'])) em PHP é uma estrutura condicional que 
 * verifica se a variável $_GET['op'] foi definida.
 * $_GET['op']: É uma maneira de acessar dados passados para o script PHP 
 * através da URL. O $_GET é uma superglobal no PHP que contém todas as  
 * variáveis passadas via parâmetros na URL. 
 * isset($_GET['op']): isset é uma função em PHP que verifica se uma  
 * variável está definida e não é nula. Neste caso, estamos verificando  
 * se a variável $_GET['op'] está definida.
 */
if (isset($_GET['op'])) {
	$op = $_GET['op'];
} else {
	$op = "Non";
}

?>
<!DOCTYPE html>
<html>
 <head><title>Novo agendamento</title></head>
 <body>
<?php
switch ($op) {
	case 'nova':
?>
	 <form action="controle.php" method="GET">
		 <input type="hidden" name="op" value="new">
   <p><label for="paciente">Nome do Paciente:</label>
    <select id="paciente" name="paciente">
     <option value="0">Novo paciente</option>
<?php
  $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE); 
  $dados = mysqli_query($con, "select * from vPacientesPorNome");
  mysqli_close($con);
  while ($linha = mysqli_fetch_assoc($dados)) {
  	$id = $linha["id_pac"];
  	$nome = $linha["nome"];
  	echo "     <option value=\"$id\">$nome</option>\n";
  }
?>
    </select></p>
   <p><label for="medico">Nome do Médico:</label>
    <select id="medico" name="medico">
<?php
  $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE); 
  $dados = mysqli_query($con, "select * from vMedicosPorNome");
  mysqli_close($con);
  while($linha = mysqli_fetch_assoc($dados)){
  	$crm = $linha["crm"];
  	$nome = $linha["nome"];
  	$espec = $linha["especialidade"];
  	echo "     <option value=\"$crm\">$nome ($espec)</option>\n";
  }
?>
    </select></p>
   <p><label for="data">Data da Consulta:</label>
    <input type="date" id="data" name="data"></p>
   <p><label for="hora">Hora da Consulta:</label>
    <input type="time" id="hora" name="hora"></p>
   <p><label for="carteira">Carteira: </label>
    <select id="carteira" name="carteira">
<?php
  $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE); 
  $dados = mysqli_query($con, "select * from vCarteiras");
  mysqli_close($con);
  while($linha = mysqli_fetch_assoc($dados)){
  	$carteira = $linha["carteira"];
  	echo "     <option value=\"$carteira\">$carteira</option>\n";
  }
?>
    </select></p> 
   <p><input type="submit" value="Agendar Consulta"></p>
  </form>
<?php	 
		break;
	case 'new':
	 $id_pac = $_GET["paciente"];
	 $crm = $_GET["medico"];
   $data = $_GET["data"];
   $hora = $_GET["hora"];
	 $datahora = $data . ' ' . $hora;
	 $carteira = $_GET["carteira"];
   if ($id_pac > 0) {
    $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE); 
    mysqli_query($con, "call spIncluiConsulta('$datahora', $id_pac, '$crm', '$carteira')");
    mysqli_close($con);
/* O comando header("Location: index.php"); em PHP é usado para redirecionar 
 * o navegador do usuário para outra página, no caso, "index.php". 
 * header: É uma função em PHP que envia um cabeçalho HTTP ao navegador.  
 * Este cabeçalho pode conter várias informações, incluindo instruções de redirecionamento. 
 * "Location: index.php": É o cabeçalho HTTP que indica ao navegador para  
 * redirecionar para a página "index.php". O Location é um cabeçalho  
 * específico usado para redirecionar o navegador para uma nova localização.
 */    
    header("Location: index.php");
   } else {
?>
  <form action="controle.php" method="GET">
   <input type="hidden" name="op" value="newP">
   <input type="hidden" name="medico" value="<?php echo $crm ?>">
   <input type="hidden" name="data" value="<?php echo $data ?>">
   <input type="hidden" name="hora" value="<?php echo $hora ?>">
   <input type="hidden" name="carteira" value="<?php echo $carteira ?>">
   <p><label for="nome">Nome do Paciente:</label>
    <input type="text" id="pac" name="pac"></p>
   <p><input type="submit" value="Incluir e agendar"></p>
  </form>
<?php
   }
	 break;
 case 'newP':
   $medico =  $_GET["medico"];
   $datahora = $_GET["data"] . ' ' . $_GET["hora"];
   $carteira = $_GET["carteira"];
   $paciente = $_GET["pac"];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE); 
   $dados = mysqli_query($con, "call spIncluiPaciente('$paciente', @id)");
   $linha = mysqli_fetch_array($dados);
   mysqli_close($con);
   $pac = $linha[0];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE);
   mysqli_query($con, "call spIncluiConsulta('$datahora', $pac, '$medico', '$carteira')");
   mysqli_close($con);
   header("Location: index.php");
  break;
 case 'newM':
?>
   <form>
    <input type="hidden" name="op" value="nMed">
    <p><label for="crm">CRM do Médico:</label>
     <input type="text" id="crm" name="crm"></p>
    <p><label for="nome">Nome do Médico:</label>
     <input type="text" id="nome" name="nome"></p>
    <p><label for="espec">Especialidade:</label>
     <input type="text" id="espec" name="espec"></p>
    <p><input type="submit" value="Incluir"></p>
   </form> 
<?php
  break;
 case 'nMed':
   $crm =  $_GET["crm"];
   $nome =  $_GET["nome"];
   $espec = $_GET["espec"];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE);
   mysqli_query($con, "call spIncluiMedico('$crm', '$nome', '$espec')");
   mysqli_close($con);
   header("Location: index.php");
  break; 
 case 'canc':
   $id = $_GET["id"];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE);
   mysqli_query($con, "call spCancelaConsulta($id)");
   mysqli_close($con);
   header("Location: index.php");
  break; 
 case 'alt':
   $id = $_GET["id"];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE);
   $dados = mysqli_query($con, "call spConsultaPorId($id)");
   $linha = mysqli_fetch_array($dados);
   $paciente = $linha["paciente"];
   $medico = $linha["medico"];
?>
  <form action="controle.php" method="GET">
   <input type="hidden" name="op" value="altCons">
   <input type="hidden" name="id" value="<?php echo $id ?>">
   <p><label for="paciente">Nome do Paciente:</label>
    <input type="text" name="paciente" id="paciente" value="<?php echo $paciente ?>" disabled></p>
   <p><label for="medico">Nome do Médico:</label>
    <input type="text" name="medico" id="medico" value="<?php echo $medico ?>" disabled></p>
   <p><label for="data">Data da Consulta:</label>
    <input type="date" id="data" name="data"></p>
   <p><label for="hora">Hora da Consulta:</label>
    <input type="time" id="hora" name="hora"></p>
   <p><input type="submit" value="Alterar Consulta"></p>
  </form>
<?php
  break; 
 case 'altCons':
   $id = $_GET["id"];
   $datahora = $_GET["data"] . ' ' . $_GET["hora"];
   $con = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BASE);
   mysqli_query($con, "call spAlteraConsulta ($id, '$datahora')");
   mysqli_close($con);
   header("Location: index.php");
  break; 
	default:
		die("Operação desconhecida");
		break;
}
?>
 </body>
</html>