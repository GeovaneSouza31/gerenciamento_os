<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório OS</title>

    <style>
        body {
            font-family: Arial;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #eee;
        }
    </style>
</head>
<body>

<h1>Relatório de Ordens de Serviço</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Usuário</th>
            <th>Status</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
        @foreach($ordens as $os)
        <tr>
            <td>{{ $os->id }}</td>
            <td>{{ $os->titulo }}</td>
            <td>{{ $os->usuario->name }}</td>
            <td>{{ $os->status }}</td>
            <td>{{ $os->created_at->format('d/m/Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>