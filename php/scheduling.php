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

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Seu carrinho</span>
                        <span class="badge bg-primary rounded-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-body-secondary">Brief description</small>
                            </div>
                            <span class="text-body-secondary">$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>
                    </ul>

                    
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Agendamento</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="placa_carro" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Insira uma marca valida
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="placa_carro" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Insira um modelo de carro valido
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <label for="lastName" class="form-label">Cor</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Horario invalido
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="lastName" class="form-label">Ano</label>
                                <input type="number" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Horario invalido
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="country" class="form-label">Tipo</label>
                                <select class="form-select" id="funcionario" required>
                                    <option value="">Escolha...</option>
                                    <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um funcionario
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <label for="lastName" class="form-label">Plano do carro</label>
                                <input type="" class="form-control" id="placa_carro" name="placa_carro" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Placa invalida
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">Funcionario</label>
                                <select class="form-select" id="funcionario" required>
                                    <option value="">Escolha...</option>
                                    <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um funcionario
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="state" class="form-label">Produto</label>
                                <select class="form-select" id="produto" required>
                                    <option value="">Escolha...</option>
                                    <option>California</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor selecione um produto
                                </div>
                            </div>

                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Fechar agendamento</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-body-secondary text-center text-small">
            <p class="mb-1">&copy; 2017–2023 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="checkout.js"></script>
</body>

</html>