<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MainCategory;

class SubCategory extends Model
{
    use HasFactory;


    protected $table = 'sub_categories';

    protected $fillable = [
        'id',
        'category_id',
        'parent_id',
        'translation_lang',
        'translation_of',
        'name',
        'slug',
        'photo',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



    public function scopeActive($query){
        return $query -> where ('active',1);
    }

    public function scopeSelection($query){
        return $query ->select('id','category_id','parent_id','translation_lang','name','slug','photo','active','translation_of');
    }


    public function getPhotoAttribute($val){
        return ($val !== null) ? asset('public/'.$val) : "";
    }



    public function getActive(){

        return $this -> active == 1 ? 'مفعل' : 'غير مفعل';

    }





    //get main category of sub category

    public  function category(){
        return $this -> belongsTo(MainCategory::class,'category_id','id');
    }



    public  function meal(){
        return $this -> hasMany(Add_meal::class,'category_id','id');
    }

}
