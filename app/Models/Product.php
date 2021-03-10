<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{

    use HasFactory;

    const STARTER = 1;
    const FULL = 2;

    /**
     * @var array
     */

    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = [];

    public static function paid()
    {
        return self::whereIn('id', [self::STARTER, self::FULL])
             ->orderBy('ordinal', 'asc')
             ->get();
    }

    public function priceInCents(){
        return $this->price * 100;
    }
}
