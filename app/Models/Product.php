<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    /**
     * Increase quantity by 1 (in-memory only, no DB).
     */
    public function increase()
    {
        $this->quantity++;
        return $this->quantity;
    }

    /**
     * Decrease quantity by 1 if possible (in-memory only, no DB).
     */
    public function decrease()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            return true;
        }

        return false;
    }
}
