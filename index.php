<?php
if (!isset($_SESSION)) {
  session_start();
}

$SERVER = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "lava_rapido";

$con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);



?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <link rel="icon" href="img/icon.png">
  <title>Lava-rapido</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">



  <link rel="stylesheet" href="style/style.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>

  <link href="carousel.css" rel="stylesheet">
</head>

<main>

  <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/wallpaper5.jpg" alt="" width="100%" height="100%" style="filter: blur(2px) brightness(50%);">
        <div class="container">
          <div class="carousel-caption text-start">
            <?php
            if (isset($_SESSION['id'])) {
              $id = $_SESSION['id'];
              $sql_code = "CALL spPegarNomeClientePeloId($id)";
              $sql_query = $con->query($sql_code) or die("FALHA: " . $con->error);
              $usuario = $sql_query->fetch_assoc();
              echo "<h1>Olá " . $usuario['nome'] . "</h1>";
              echo '<p class="opacity-75">Pronto. Agora você já pode aproveitar o melhor de nossos serviços. <br/> Faça seu agendamento conosco agora mesmo!</p>';
              echo '<p><a class="btn btn-lg btn-secondary" href="php/logout.php">Logout</a>
              <button type="button" class="btn btn-lg btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Ver agendamentos
</button>
</p>';


            } else {
              echo "<h1>Faça login agora</h1>";
              echo '<p class="opacity-75">Ainda não é cadastrado? <br/> Faça seu cadastro agora mesmo e aproveite o melhor de nossos serviços.</p>';
              echo '<p><a class="btn btn-lg btn-secondary" href="php/login.php">Entrar</a></p>';
            }

            $con->close();
            ?>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Seus agendamentos</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <?php

                  $con = mysqli_connect($SERVER, $USER, $PASSWORD, $DB);

                  // Consulta SQL para obt  er os agendamentos
                  $query = "CALL spPegarAgendamentoPeloId($id)";
                  $result = $con->query($query);

                  if ($result->num_rows > 0) {
                    echo "<div style='overflow-x: auto;'>";
                    echo "<table class='table'>";
                    echo "<thead><tr>";
                    echo "<th>Código</th>";
                    echo "<th>ID do Produto</th>";
                    echo "<th>CPF do Funcionário</th>";
                    echo "<th>ID do Cliente</th>";
                    echo "<th>Placa do Carro</th>";
                    echo "<th>ID da Lavagem</th>";
                    echo "<th>Horário</th>";
                    echo "<th>Ação</th>";
                    echo "</tr></thead>";
                    echo "<tbody>";
                    
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td style='white-space: nowrap;'>" . $row['codigo'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['id_produto'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['cpf_funcionario'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['id_cliente'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['placa_carro'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['id_lavagem'] . "</td>";
                      echo "<td style='white-space: nowrap;'>" . $row['horario'] . "</td>";
                      echo "<td style='white-space: nowrap;'>";
                      echo "<form method='post' action='php/delete.php'>";
                      echo "<input type='hidden' name='codigo' value='" . $row['codigo'] . "'>";
                      echo "<input type='submit' class='btn btn-danger' value='Excluir'>";
                      echo "</form>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                  }
                   else {
                    echo "Nenhum agendamento encontrado.";
                  }

                  $con->close();

                  ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">Agendar</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="carousel-item">
        <img src="img/wallpaper6.jpg" alt="" width="100%" height="100%" style="filter: blur(3px) brightness(50%);">
        <div class="container">
          <div class="carousel-caption">
            <h1>O melhor lava-rapido da região!</h1>
            <p>Seu carro precisa de uma tratada? agende uma visita hoje mesmo!</p>
            <p><a class="btn btn-lg btn-secondary" href="php/scheduling.php">Agendar</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
          role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/wallpaper8-removebg-preview.png" x="0" y="0" width="140" height="140" />
        </svg>
        <h2 class="fw-normal">Produtos selecionados</h2>
        <p>Aqui você encontrará uma seleção exclusiva dos melhores produtos do mercado para deixar o seu carro
          impecável.</p>
        <p><a class="btn btn-secondary" href="#products">Saiba mais &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
          role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/bola2.png" x="-25" y="-30" width="170" height="200" />
        </svg>
        <h2 class="fw-normal">Garantia de qualidade</h2>
        <p>Excelência Garantida: Compromisso com a Qualidade. Nossa busca incessante pela perfeição. Satisfação do
          cliente, nossa missão.</p>
        <p><a class="btn btn-secondary" href="#quality">Saiba mais &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg"
          role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/bola3.png" x="0" y="0" width="140" height="140" />
        </svg>
        <h2 class="fw-normal">Melhor preço da região</h2>
        <p>Economia Garantida para seu Bolso. Qualidade e Custos Imbatíveis, Somos a Sua Escolha. Não perca as Ofertas
          Incríveis que Temos a Oferecer!</p>
        <p><a class="btn btn-secondary" href="#price">Saiba mais &raquo;</a></p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

    <!-- START THE FEATURETTES -->
    <div id="products"></div>
    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Os melhores produtos você acha aqui. <span
            class="text-body-secondary">O melhor para seu carro</span></h2>
        <p class="lead">Explore o nosso irresistível catálogo de produtos e descubra a escolha perfeita para satisfazer
          todas as suas necessidades. Cada item é minuciosamente selecionado por nossos especialistas, garantindo
          excelência e qualidade incomparáveis.
        </p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
          height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
          preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/featurette1.jpeg" x="10" y="10" />

        </svg>
      </div>
    </div>
    <div id="quality"></div>
    <hr class="featurette-divider">

    <div id="quality" class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Garantimos qualidade inigualável. <span
            class="text-body-secondary">Cliente em primeiro lugar.</span></h2>
        <p class="lead">No nosso lava-rápido exclusivo, contamos com uma equipe de funcionários altamente dedicados, uma
          distinção única no mercado. Essa dedicação é comprovada e respaldada pelos profissionais especializados no
          setor. A garantia de qualidade é um dos nossos pilares, assegurando que a sua experiência conosco seja
          verdadeiramente excepcional.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
          height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
          preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/featurette2.jpeg" x="10" y="10" />
        </svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div id="price" class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Qualidade incomparável e preços imbatíveis. <span
            class="text-body-secondary">Suas melhores ofertas</span></h2>
        <p class="lead">Em novo lava-rapido, você encontrará uma economia imbatível que não pesará no seu bolso.
          Comprometemo-nos a proporcionar qualidade excepcional a preços altamente competitivos, tornando-nos a escolha
          mais inteligente para você. Não deixe escapar as oportunidades incríveis que temos para oferecer!</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
          height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
          preserveAspectRatio="xMidYMid slice" focusable="false">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" />
          <image href="img/featurette3.png" x="10" y="10" />
        </svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Voltar ao inicio</a></p>
    <p>&copy; 2023 Pablo Cauê</p>
  </footer>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<?php

?>