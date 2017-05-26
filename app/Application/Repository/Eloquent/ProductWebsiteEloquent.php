<?php
namespace App\Application\Repository\Eloquent;


use App\Application\Model\Categorie;
use App\Application\Model\Country;
use App\Application\Model\Product;
use App\Application\Model\State;
use App\Application\Repository\InterFaces\ProductWebsiteInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProductWebsiteEloquent extends AbstractEloquent implements ProductWebsiteInterface
{

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getBySlug($slug)
    {
        $slug = reverseSlug($slug);
        $product = $this->getProductBySlug($slug);
        if ($product) {
            return $product;
        }
        return false;
    }

    public function getProductBySlug($slug)
    {
        $item =  $this->model->where('name', $slug)->with('state', 'country', 'cat')->first();
        if($item->user_id == auth()->user()->id){
            return $item;
        }else{
            if($item->status != 'success'){
                return false;
            }else{
                return $item;
            }
        }
    }


    public function getProduct($slug, $state, $cat)
    {
        if ($slug != 'allCountry') {
            return $this->getPrductByCountrySlug($slug, $state, $cat);
        }
        if (Auth::check()) {
            $user = auth()->user();
            return $this->getProductByCountry($user->country_id, $state, $cat);
        } else {
            return $this->getLatestProduct($cat);
        }
    }

    public function getProductByCountry($country_id, $state, $cat, $pagination = 20)
    {
        $items = $this->model->where('status', 'success')->with('country', 'state', 'cat');
        if ($cat != null || $state != null) {
            $cat = $this->getCatBySlug($cat);
            if (!$cat) {
                $cat = $this->getCatBySlug($state);
            }
            if ($cat) {
                $items = $items->where('cat_id', $cat->id);
            }
            $state = $this->getStateBySlug($state);
            if ($state) {
                $items = $items->where('state_id', $state->id);
            }
        }
        $items = $items->where('country_id', $country_id)->orderBy('id' , 'desc')->paginate($pagination);
        return $items;
    }


    public function getLatestProduct($cat, $limit = 20, $orderBy = 'id')
    {
        $items = $this->model->where('status', 'success')->with('country', 'state', 'cat');
        if ($cat != null) {
            $cat = $this->getCatBySlug($cat);
            $items = $items->where('cat_id', $cat->id);
        }
        $items = $items->limit($limit)->orderBy($orderBy, 'desc')->get();
        return $items;
    }

    public function getPrductByCountrySlug($slug, $state, $cat)
    {
        $coutnry = Country::where('slug', $slug)->first();
        if ($coutnry) {
            return $this->getProductByCountry($coutnry->id, $state, $cat);
        }
        return redirect('404');
    }

    public function getCatBySlug($slug)
    {
        return Categorie::where('slug', $slug)->first();
    }

    public function getCountryBySlug($slug)
    {
        return Country::where('slug', $slug)->first();
    }

    public function getStateBySlug($slug)
    {
        return State::where('slug', $slug)->first();
    }

    public function getAuthUserAds()
    {
        $user = auth()->user();
        return $this->model->where('user_id', $user->id)->orderBy('id' , 'desc')->with('state', 'country', 'cat')->get();
    }


    public function authUserAddAds($request)
    {
        $valid = Validator::make($request->all(), $this->model->userAddValidation());
        if ($valid->fails()) {
            return redirect()->back()->with(['errors' => $valid->errors()]);
        }

        $request = uploadFile($request , 'image');

        $newAds = new Product();
        $newAds->name = $request['name'];
        $newAds->des = $request['des'];
        $newAds->price = $request['price'];
        $newAds->lat = $request['lat'];
        $newAds->lng = $request['lng'];
        $newAds->phone = $request['phone'];
        $newAds->country_id = $request['country_id'];
        $newAds->state_id = $request['state_id'];
        $newAds->cat_id = $request['cat_id'];
        $newAds->image = $request['image'];
        $newAds->user_id = auth()->user()->id;
        $newAds->status = 'wating';
        $newAds->save();
        return redirect('/');
    }


    public function search($request){
        $items = $this->model->where('status' , 'success')->with('state', 'country', 'cat');
        if($request->q != null){
            $items = $items->where('name' , 'like' , '%'.$request->q.'%');
        }

        if($request->country != null){
            $country = $this->getCountryBySlug($request->country);
            $items = $items->where('country_id' , $country->id);
        }
        if($request->cat_id != null){
            $cat = $this->getCatBySlug($request->cat_id);
            $items = $items->where('cat_id' , $cat->id);
        }

        if($request->state != null){
            $items = $items->where('state_id' , $request->state);
        }




        if($request->price != null){
            $items = $items->where('price' , $request->price);
        }

        return $items->paginate(20);


    }


}