<?php

function getCountryForUser(){
    return transformSelect(\App\Application\Model\Country::pluck('name' , 'id')->all());
}

function getCountryBySlug(){
    return \App\Application\Model\Country::pluck('name' , 'slug')->all();
}

function slug($slug){
    return trim(str_replace(' ' , '_' ,$slug));
}

function reverseSlug($slug){
    return str_replace('_' , ' ' ,$slug);
}

function getAllCats(){
    return \App\Application\Model\Categorie::pluck('name' , 'slug')->all();
}


function getAllCatsWithTransform(){
    return transformSelect(\App\Application\Model\Categorie::pluck('name' , 'id')->all());
}

function getCurrectCountry(){
    if(request()->segment(2)){
        if(in_array(request()->segment(2) , expectSigment())){
            if(request()->segment(3)){
                if(!in_array(request()->segment(3) , expectSigment())){
                    return request()->segment(3);
                }
                return  'allCountry';
            }
            return  'allCountry';
        }
        return request()->segment(2);
    }
    return  'allCountry';
}

function expectSigment(){
    return [
        'register' ,
        'login',
        'product',
        'user',
        'ads',
        'addNewAds',
        'addAds',
        'search'
    ];
}


function uploadFile($request , $field){
    if($request->file($field) != null){
        $destinationPath = env('UPLOAD_PATH');
        $all = [];
        $imageName = '';
        if(is_array($request->file($field))){
            foreach($request->file($field)  as $file){
                $all[] = uploadFileOrMultiUpload($file , $destinationPath);
            }
        }else{
            $imageName = uploadFileOrMultiUpload($request->file($field) , $destinationPath);
        }
        $request = $request->except($field);
        if(count($all) > 0){
            $request[$field] = json_encode($all);
            return $request;
        }
        $request[$field] = $imageName;
        return $request;
    }
    return $request->all();
}

function uploadFileOrMultiUpload($image , $destinationPath){
    $extension = $image->getClientOriginalExtension();
    $fileName = rand(11111,99999).'_'.time().'.'.$extension;
    if($image->move($destinationPath  , $fileName)){
        return $fileName ;
    }
}