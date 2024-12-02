<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    

    protected $table = 'carts';
    protected $primaryKey = 'iduser'; // Không dùng cột mặc định 'id' làm khóa chính
    public $incrementing = false;  // Kiểu dữ liệu khóa chính (tùy theo cột bạn dùng)
    protected $fillable = ['iduser', 'idpv', 'soluong'];
}
