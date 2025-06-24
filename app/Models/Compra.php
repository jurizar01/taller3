<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Compra extends Model
{
    use HasFactory;
    protected $table = 'tbl_compras';
    protected $fillable = [
        'cliente_id',
        'fecha',
        'medio_pago',
        'comentario',
        'estado',
        'id_usuario',

    ];
}
