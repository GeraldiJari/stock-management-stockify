<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stock Transaksi - {{ $type }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    
    @php
        use Carbon\Carbon;
    @endphp

    <h2>Laporan Stock Transaksi - {{ $type }}</h2>
    <p>Tanggal: {{ now()->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->product->name }}</td>
                <td>{{ $transaction->quantity }}</td>
                <td>{{ Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->notes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
