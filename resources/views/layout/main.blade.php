<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Oficina Pro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-indigo: #4f46e5;
            --dark-slate: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Clean */
        header {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--dark-slate);
            letter-spacing: -0.5px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav-login {
            background: #f1f5f9;
            color: #475569;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .btn-nav-login:hover {
            background: var(--primary-indigo);
            color: white;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 40px 0;
        }

        /* Alerts Estilizados */
        .custom-alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            margin: 0 auto 30px auto;
            max-width: 450px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer */
        footer {
            padding: 2rem 0;
            text-align: center;
            font-size: 0.85rem;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
        }
    </style>
</head>
<body>

    <header>
        <nav class="nav-container">
            <a href="/" class="logo-text">
                <i class="bi bi-gear-fill text-primary"></i> 
                Chamados <span class="text-primary">TI</span>
            </a>
            <a href="/login" class="btn-nav-login">
                <i class="bi bi-box-arrow-in-right me-1"></i> Acessar
            </a>
        </nav>
    </header>

    <main class="container">
        
        @if(session('success'))
            <div class="alert alert-success custom-alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger custom-alert d-block">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-exclamation-octagon-fill fs-5"></i>
                    <strong>Atenção:</strong>
                </div>
                <ul class="mb-0 ps-4 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
        @yield('conteudo') {{-- Adicionado por precaução caso mude o nome --}}
        
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} <strong>Oficina Pro</strong> - Gestão Inteligente de Ordem de Serviços.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>