<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $fillable=[
        'section_name',
        'description',
        'Created_by'
    ];
//    public function products(){
//        return $this->hasMany(Product::class);
//    }
}
