<?php

namespace App\Application\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

  public $table = "contact";


   protected $fillable = [
        'name' , 'email' , 'message'
   ];

    public $timestamps = false;

   public function validation($id){
        return [
            'name' => 'required|min:5|max:100' ,
            'email' => 'required|email',
            'message' => 'required|min:20|max:500'
        ];
   }

   public function updateValidation($id){
           return [
               'name' => 'required|min:5|max:100' ,
               'email' => 'required|email',
               'message' => 'required|min:20|max:500'
           ];
   }

}
