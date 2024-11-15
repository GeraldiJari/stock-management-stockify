<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100%; /* Memastikan gambar responsif */
            height: auto; /* Memastikan proporsi gambar tetap */
        }
        .centered {
            text-align: center; /* Mengatur teks di tengah */
            margin-bottom: 20px; /* Memberikan jarak bawah pada gambar */
        }
    </style>
</head>
<body>


    <div class="centered">
        <img src="{{ $image }}" alt="Logo" />
    </div>
    
    <h2 style="text-align: center;">Stock Transactions</h2>

<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>User</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stok as $transaction)
        <tr>
            <td>{{ $transaction->product->name }}</td>
            <td>{{ $transaction->user->name }}</td>
            <td>{{ $transaction->type }}</td>
            <td>{{ $transaction->quantity }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
