<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_meal extends Model
{
    use HasFactory;

    protected $table = 'add_meals';

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'photo',
        'price',
        'description',
        'active',
        'translation_lang',
        'translation_of',
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


    public function getPhotoAttribute($val){
        return ($val !== null) ? asset('public/'.$val) : "";
    }

    public function scopeSelection($query)
    {
        return $query->select('id','category_id','name','photo','price','description','active','translation_lang','translation_of');
    }





    public function getActive(){

        return $this -> active == 1 ? 'مفعل' : 'غير مفعل';

    }


//    public  function mainCategories(){
//        return $this -> belongsTo(MainCategory::class,'category_id','id');
//    }


    //get sub category of meal

    public  function category(){
        return $this -> belongsTo(SubCategory::class,'category_id','id');
    }

}
