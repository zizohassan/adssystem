<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

  public $table = "country";


   protected $fillable = [
        'name' , 'slug'
   ];

    public $timestamps = false;

   public function validation($id){
        return [
            'name' => 'required|unique:country',
            'slug' => 'required|unique:country'
        ];
   }

   public function updateValidation($id){
           return [
               'name' => 'required|unique:country,name,'.$id,
               'slug' => 'required|unique:country,slug,'.$id
           ];
   }

    public function product(){
        return $this->hasMany('App\Application\Model\Product');
    }

}
