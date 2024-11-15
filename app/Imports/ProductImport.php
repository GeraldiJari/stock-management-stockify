<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category_id'    => $row['category_id'],  // pastikan data cocok dengan header CSV/Excel
            'supplier_id'    => $row['supplier_id'],
            'name'           => $row['name'],
            'sku'            => $row['sku'],
            'description'    => $row['description'],
            'purchase_price' => $row['purchase_price'],
            'selling_price'  => $row['selling_price'],
            'image'          => $row['image'],
        ]);
    }
}
