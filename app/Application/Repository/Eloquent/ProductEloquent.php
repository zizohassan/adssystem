<?php
namespace App\Application\Repository\Eloquent;

use App\Application\Model\Categorie;
use App\Application\Model\Country;
use App\Application\Model\Product;
use App\Application\Model\State;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\ProductInterface;


class ProductEloquent extends AbstractEloquent implements ProductInterface{

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getData($id){
        $country = transformSelect(Country::pluck('name' , 'id')->all());
        $cats = transformSelect(Categorie::pluck('name' , 'id')->all());
        if($id != null){
            $item = $this->model->find($id);
            $user = User::find($item->user_id);
            $state = transformSelect(State::where('country_id' , $item->country_id)->pluck('name' , 'id')->all());
        }else{
            $user = null;
            $state = [];
        }
        return $data = [
            'country' => $country,
            'state' => $state,
            'cat_id' => $cats,
            'user_id' => $user
        ];
    }




}