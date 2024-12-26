@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relatorio de vida util de viatura</title>
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
            margin: 5;
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
            padding: 20px;
        }

        .content .section {
            margin-bottom: 15px;
        }

        .content .section h3 {
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        /* Estilo do thead */
.table th {
    background-color: #f2f2f2;
    border: 2px solid #333; /* Adicionando uma borda mais forte */
    padding: 8px;
    text-align: center; /* Alinha o texto ao centro */
}

/* Ajustando o alinhamento das colunas no thead e tbody */
.table th, .table td {
    padding: 8px;
    border: 1px solid #ddd; /* Borda fina para as células */
    text-align: left; /* Por padrão, alinhamos o conteúdo das células à esquerda */
}

/* Caso queira garantir um alinhamento específico nas colunas da tabela */
.table th:nth-child(1), .table td:nth-child(1) {
    text-align: left; /* Alinhamento à esquerda para a primeira coluna */
}

.table th:nth-child(2), .table td:nth-child(2) {
    text-align: center; /* Alinhamento centralizado para a segunda coluna */
}

.table th:nth-child(3), .table td:nth-child(3) {
    text-align: right; /* Alinhamento à direita para a terceira coluna */
}

/* Separação entre o thead e o tbody */
.table thead {
    border-bottom: 2px solid #333; /* Adiciona uma linha de separação */
}
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            text-transform: uppercase;
        }

        .card h1 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        .card h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .card h3 {
            font-size: 14px;
            margin-top: 20px;
            text-align: center;
        }

        .card p {
            font-size: 13px;
            margin: 8px 0;
        }

        .card span {
            font-weight: bold;
        }

        .order-info {
            margin-bottom: 20px;
        }

        .highlight-red {
            color: #EF4444;
        }

    </style>
</head>
<body>
    <div class="header">
        {{-- <img src="{{ public_path('img/logo_bprv.png') }}" class="logo-left" alt="Logo PMPR"> --}}
        <img src="{{ public_path('img/brasao/' . $vehicle->subCommand->image) }}" class="logo-left" alt="Logo da OPM">
       
        <img src="{{ public_path('img/logo_pmpr.jpg') }}" class="logo-right" alt="Logo PMPR">
        <h2>ESTADO DO PARANÁ</h2>
        <h2>POLÍCIA MILITAR</h2>
        {{-- <h3>COMANDO DE POLICIAMENTO ESPECIALIZADO</h3> --}}
        {{-- <h3>BATALHÃO DE POLÍCIA RODOVIÁRIA</h3> --}}
        <h3>{{ $vehicle->subCommand->regional_command->name }}</h3>
        <h3>{{ $vehicle->subCommand->name }}</h3>
        <br>
        <div class="line"></div>
    </div>

    <div class="card">
        <!-- Relatório do Veículo -->
        <h1>Relatório do Veículo</h1>
        <h2>{{ $vehicle->brand }}       {{ $vehicle->model }}       ({{ $vehicle->year }})</h2>
        <h3>Placa: {{ $vehicle->plate }} Prefixo: {{ $vehicle->prefix }} Tabela Fipe: (R$ {{ number_format($vehicle->price, 2, ',', '.') }})</h3>
    
        <!-- Resumo das Ordens de Serviço -->
        <div class="section">
            <h3>Resumo das Ordens de Serviço</h3>
            <p><strong>Total de Ordens de Serviço:</strong> <span class="highlight-red">R$ {{ number_format($totalOrders, 2, ',', '.') }}</span></p>
        </div>

        <!-- Ordens de Serviço -->
        @foreach ($serviceOrders as $order)
            @php
                // Formatação da data com Carbon
                $formattedDate = Carbon::parse($order->service_date)->format('d/m/Y');
            @endphp
            <div class="order-info">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Oficina: {{ $order->workshop->razao_social }}</th>
                            <th colspan="1">Data: {{ $formattedDate }}</th>
                            <th colspan="1">Status: {{ $order->situation->description }}</th>
                            <th colspan="1">n°  {{ $order->id }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6"><strong>Descrição:</strong> {{ $order->description }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Produtos Associados -->
                @if ($order->products->isNotEmpty())
                    <h4>Produtos Associados</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produtos e paças</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->product_quantity }}</td>
                                    <td>R$ {{ number_format($product->pivot->product_price, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p><strong>Nenhum produto ou peça nessa ordem de serviço.</strong></p>
                @endif

                <!-- Totais -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total de Mão de Obra</th>
                            <th>Total de Produtos</th>
                            <th>Total da Ordem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> 
                            <td>R$ {{ number_format($order->labor_total, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($order->total_service_order, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($order->total_service_order + $order->labor_total, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
        @endforeach
    </div>
</body>
</html>
