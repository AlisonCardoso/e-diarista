<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordem de Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        .header h1, .header h2, h3 {
            margin: 0;
        }
        .logo-left {
                float: left;
            }
            .logo-right {
                float: right;
            }

        .line {
            border-bottom: 2px solid #000;
            margin-top: 20px;
            margin-bottom: 20px;
        }
         
        .content {
                border-top: 1px solid #000;
                clear: both;
                margin-top: 20px;
                text-align: center;
            }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #87bef5;
        }

        table, th {
            border: 1px solid black;
            background-color: #545869;
            border-top: none;
        }

        table, td {
            border: 1px solid black;
            background-color: #f0ecec;
            border-top: none;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        footer {
            width: 100%;
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 100px;
            color: #000;
            text-align: center;
            line-height: 35px;
            border-top: 1px solid #000;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logo_bprv.png') }}" class="logo-left" alt="Logo pbrv"> <!-- Ajuste o tamanho se necessário -->
        <img src="{{ public_path('img/logo_pmpr.jpg') }}"class="logo-right"  alt="Logo PMPR">
        <h2>ESTADO DO PARANÁ</h2>
        <h2>POLÍCIA MILITAR</h2>
        <h3>COMANDO DE POLICIAMENTO ESPECIALIZADO</h3>
        <h3>BATALHÃO DE POLÍCIA RODOVIÁRIA</h3>
        <br>
      <div class="line"></div>
    </div>


    <div class="content">
        <h1>Relatório de Ordens de Serviço</h1>
        <p>Data: {{ date('d/m/Y') }}</p>
    </div>

    

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Veículo</th>
                <th>Oficina</th>
                <th>Situação</th>
                <th>Data do Serviço</th>
                <th>Mão de Obra</th>
                <th>Valor Produtos</th>
                <th>Total Orçamento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($serviceOrders as $serviceOrder)
            <tr>
                <td>{{ $serviceOrder->id }}</td>
                <td>{{ $serviceOrder->vehicle->plate ?? 'N/A' }}</td>
                <td>{{ $serviceOrder->workshop->razao_social ?? 'N/A' }}</td>
                <td>{{ $serviceOrder->situation->description }}</td>
                <td>{{ \Carbon\Carbon::parse($serviceOrder->service_date)->format('d/m/Y') }}</td>
                <td>R$ {{ number_format($serviceOrder->calculateLaborTotal(), 2, ',', '.') }}</td>
                <td>R$ {{ number_format($serviceOrder->calculateProductTotal(), 2, ',', '.') }}</td>
                <td>R$ {{ number_format($serviceOrder->calculateTotal(), 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">Nenhum serviço encontrado</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="7">Total</td>
                <td>R$ {{ number_format($totalValor, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <footer>
        <p>Relatório gerado em: {{ date('d/m/Y h:i A') }}</p>
    </footer>
</body>
</html>
