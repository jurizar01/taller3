<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Producto;
class ProductoSeeder extends Seeder
{

    public function run(): void
    {
        Producto::insert([
[
            'nombre'=>'Smartphone X1',
            'categoria_id'=>1,
            'codigo_barras'=>'1234567890123',
            'precio_venta'=>1200.00,
            'cantidad_stock'=>15,
            'estado'=>true,
            'created_at'=>now(),
            'updated_at'=>now(),

        ],

            [

            'nombre'=>'Camiseta Blanca',
            'categoria_id'=>3,
            'codigo_barras'=>'3216549870012',
            'precio_venta'=>25.50,
            'cantidad_stock'=>50,
            'estado'=>true,
            'created_at'=>now(),
            'updated_at'=>now(),

        ],



        [

            'nombre'=>'Laptop Gamer Z5',
            'categoria_id'=>1,
            'codigo_barras'=>'4567891234567',
            'precio_venta'=>2500.00,
            'cantidad_stock'=>5,
            'estado'=>true,
            'created_at'=>now(),
            'updated_at'=>now(),

        ],

 ]        );


    }
}
