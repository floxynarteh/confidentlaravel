<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\OrdinalScope;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OrdinalScope());
    }

    public function isFree()
    {
        return is_null($this->product_id);
    }

    public static function course()
    {
        return self::where('product_id', '!=', [Product::FULL])
            ->orWhereNull('product_id')
            ->get();
    }
}
