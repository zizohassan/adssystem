<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  public $table = "product";

    public $timestamps = false;

   protected $fillable = [
        'name' , 'des' , 'price' , 'image' , 'status'  , 'lat' , 'lng' , 'phone' , 'country_id' , 'state_id' , 'user_id' , 'cat_id'
   ];

   public function validation($id){
        return [
            'name' => 'required|min:5|max:200' ,
            'des'  => 'required|min:20|max:600' ,
            'price'  => 'required' ,
            'image.*'  => 'required|image' ,
            'status'   => 'required' ,
            'lat'  => 'required' ,
            'lng'  => 'required' ,
            'phone'  => 'required' ,
            'country_id'  => 'required' ,
            'state_id'  => 'required' ,
            'user_id'  => 'required' ,
            'cat_id' => 'required' ,
        ];
   }

   public function updateValidation($id){
           return [
               'name' => 'required|min:5|max:200' ,
               'des'  => 'required|min:20|max:600' ,
               'price'  => 'required' ,
               'status'   => 'required' ,
               'lat'  => 'required' ,
               'lng'  => 'required' ,
               'phone'  => 'required' ,
               'country_id'  => 'required' ,
               'state_id'  => 'required' ,
               'cat_id' => 'required' ,
           ];
   }


    public function userAddValidation(){
        return [
            'name' => 'required|min:5|max:200' ,
            'des'  => 'required|min:20|max:600' ,
            'price'  => 'required' ,
            'lat'  => 'required' ,
            'lng'  => 'required' ,
            'phone'  => 'required' ,
            'country_id'  => 'required' ,
            'state_id'  => 'required' ,
            'cat_id' => 'required' ,
            'image.*' =>'required|image'
        ];
    }

   public function country(){
       return $this->belongsTo('App\Application\Model\Country');
   }

  public function state(){
        return $this->belongsTo('App\Application\Model\State' , 'state_id');
  }

  public function cat(){
        return $this->belongsTo('App\Application\Model\Categorie' , 'cat_id');
  }

}
