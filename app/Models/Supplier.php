<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function get_supplier(){
        //get all products
        $sql = $this->select("suppliers.*");
                    
        return $sql;
    }
}