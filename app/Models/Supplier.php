<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supllier_category_id','supplier_category_name','pic_name','supplier_name',
    ];

    /**
     * Mendapatkan nama Category dari supplier
     *
     * @return string
     */
    public function getCategorySupplierNameAttribute()
    {
        return $this->supplier_category_name;
    }

    /**
     * Define the relationship to the category (if applicable).
     */
    public function category()
    {
        return $this->belongsTo(Supplier::class, 'supllier_category_id', 'id');
    }
}