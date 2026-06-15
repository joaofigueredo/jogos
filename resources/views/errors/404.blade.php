<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0 rounded-3">

                <div class="modal-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 3.5rem;"></i>
                    </div>

                    <h4 class="fw-bold text-dark mb-2">Ops! Página não encontrada</h4>
                    <p class="text-muted mb-4">
                        A página que você está tentando acessar não existe ou foi movida.
                    </p>

                    <a href="{{ route('home.jogos') }}" class="btn btn-primary w-100 py-2.5 fw-semibold">
                        <i class="bi bi-arrow-left me-2"></i>Voltar para a página anterior
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>