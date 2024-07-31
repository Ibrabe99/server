<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';

    protected $fillable = [
        'id',
        'name',
        'logo',
        'mobile',
        'address',
        'email',
        'status',
        'category_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'category_id',
        'created_at',
        'updated_at',
    ];



    public function scopeActive($query){
        return $query->where('active', 1);
    }


    public function getLogoAttribute($val){
        return ($val !== null) ? asset('public/'.$val) : "";
    }

    public function scopeSelection($query)
    {
        return $query->select('id','category_id','name','active','logo','mobile');
    }


    public function category()
    {
        return $this->belongsTo(MainCategory::class, 'category_id', 'id');

    }


    public function getActive(){

        return $this -> active == 1 ? 'مفعل' : 'غير مفعل';

    }

}
