<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    
    function getMinQuantity()
    {
        return (int) Setting::where('key', 'min_quantity')->value('value') ?? 1; // Default ke 1 jika tidak ada
    }

    function getMaxQuantity()
    {
        return (int) Setting::where('key', 'max_quantity')->value('value') ?? 100; // Default ke 100 jika tidak ada
    }

    public static function getLogo(){
        return Setting::where('id', 3)  // Kondisi pertama untuk ID
                      ->where('key', 'logo')  // Kondisi kedua untuk Key
                      ->value('value') ?? 'default-logo.png'; // Mengambil nilai 'value', jika tidak ada maka default
    }
    
}
