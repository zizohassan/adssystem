<?php

namespace App\Application\Controllers;



use App\Application\Model\Country;
use App\Application\Model\Page;
use App\Application\Model\State;
use App\Application\Repository\InterFaces\ProductWebsiteInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    protected $productWebsiteInterface;
    public function __construct(ProductWebsiteInterface $productWebsiteInterface)
    {
        $this->middleware('auth')->only(['getUserAds' , 'addAds']);
        $this->productWebsiteInterface = $productWebsiteInterface;
    }

    public function getPageBySlug($slug){
        $page = Page::where('slug' , $slug)->first();
        if($page){
            return view('website.page' , compact('page'));
        }
        return redirect('404');
    }

    public function getProductBySlug($country ,$state , $cat , $slug){
        $product = $this->productWebsiteInterface->getBySlug($slug);
        if($product == false){
            return redirect('404');
        }
        $viewStatus = null;
        return view('website.product.index' , compact('product' , 'viewStatus'));
    }

    public function welcome($slug = 'allCountry' , $state = null , $cat = null ){
        $products = $this->productWebsiteInterface->getProduct($slug  , $state  , $cat);
        $viewStatus = null;
        return view('website.welcome'  , compact('products' , 'viewStatus'));
    }

    public function getUserAds(){
        $products = $this->productWebsiteInterface->getAuthUserAds();
        $viewStatus = true;
        return view('website.welcome'  , compact('products' , 'viewStatus'));
    }

    public function addAds(){
        return view('website.product.add');
    }

    public function addNewAds(Request $request){
       return $this->productWebsiteInterface->authUserAddAds($request);
    }

    public function search(Request $request){
        $products =  $this->productWebsiteInterface->search($request);
        $viewStatus = true;
        return view('website.welcome'  , compact('products' , 'viewStatus'));
    }

    public function getState($id){
        if(!(int) $id) {
            $id = Country::where('slug', $id)->first()->id;
        }
        $state =  State::where('country_id' , $id)->pluck('name' , 'id')->all();
        return json_encode(transformSelect($state));
    }

}
