<?php

namespace App\Application\Repository\InterFaces;

interface ProductWebsiteInterface{
    public function getProduct($slug  ,$state ,   $cat);
    public function getBySlug($slug);
    public function getAuthUserAds();
    public function authUserAddAds($request);
    public function search($request);
}