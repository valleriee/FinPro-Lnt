<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'name',
        'invoice_num',
        'address',
        'postal_code',
        'total_price'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public static function generateInvoiceNumber()
    {
        return 'INV' . date('YmdHis');
    }
}
