<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Oficina Pro</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg,#0f2027,#203a43,#2c5364); /* Gradiente mestre */
            color: white;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Efeito Vidro */
        .glass-header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
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
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Botões da Nav */
        .nav-actions { display: flex; gap: 12px; align-items: center; }

        .btn-glass {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #00c6ff;
            transform: translateY(-2px);
        }

        .btn-logout {
            color: #ff4b2b;
            border: 1px solid rgba(255, 75, 43, 0.3);
        }

        .btn-logout:hover {
            background: rgba(255, 75, 43, 0.1);
            color: #ff4b2b;
        }

        /* Alertas Glass */
        .custom-alert {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 15px;
            max-width: 500px;
            margin: 20px auto;
        }

        main { flex: 1; }

        footer {
            padding: 2rem 0;
            text-align: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>

    <header class="glass-header">
        <nav class="nav-container">
            <a href="/" class="logo-text">
                <i class="bi bi-gear-fill" style="color: #00c6ff;"></i> 
                Chamados <span style="color: #00c6ff;">TI</span>
            </a>

            <div class="nav-actions">
                @auth
                    <a href="{{ Auth::user()->perfil === 'admin' ? route('dashboard.admin') : route('dashboard.usuario') }}" class="btn-glass">
                        <i class="bi bi-house-door me-1"></i> Início
                    </a>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-glass btn-logout">
                            <i class="bi bi-box-arrow-right me-1"></i> Sair
                        </button>
                    </form>
                @else
                    <a href="/login" class="btn-glass">Acessar</a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success custom-alert d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill text-success"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger custom-alert">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Oficina Pro - Gestão de Ordens de Serviço</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>