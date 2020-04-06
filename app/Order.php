<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot('quantity');
    }

    // ?? dynamic properti
    public function getTotalQuantityAttribute()
    {
        $total_quantity = 0;

        foreach ($this->books() as $book) {
            $total_quantity += $book->pivot->quantity;
        }

        return $total_quantity;
    }
}
