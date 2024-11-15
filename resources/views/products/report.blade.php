<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        /* Tambahkan gaya CSS yang sesuai di sini */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
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
    
    <h2 style="text-align: center;">Product List</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Sell</th>
                <th>Date In</th>
                <th>Date Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><img src="{{ public_path('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:50px;"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->sku }}</td>
                <td>${{ $product->purchase_price }}</td>
                <td>${{ $product->selling_price }}</td>
                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                <td>{{ $product->updated_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
