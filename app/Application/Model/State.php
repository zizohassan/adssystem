<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

  public $table = "state";


   protected $fillable = [
        'name' , 'country_id' , 'slug'
   ];

    public $timestamps = false;

   public function validation($id){
        return [
            'name' => 'required|unique:state' ,
            'country_id' => 'required',
            'slug' => 'required|unique:state'
        ];
   }

   public function updateValidation($id){
           return [
               'name' => 'required|unique:state,name,'.$id ,
               'country_id' => 'required',
               'slug' => 'required|unique:state,slug,'.$id ,
           ];
   }

    public function country(){
        return $this->belongsTo('\App\Application\Model\Country');
    }

}
