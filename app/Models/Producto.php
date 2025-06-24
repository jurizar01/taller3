<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Producto extends Model
{
    use HasFactory;
    protected $table = 'tbl_productos';
    protected $fillable = [
        'nombre',
        'categoria_id',
        'codigo_barras',
        'precio_venta',
        'cantidad_stock',
        'estado',

        'id_usuario',

    ];
}
