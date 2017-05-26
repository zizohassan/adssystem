<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\ProductsDataTable;
use App\Application\Model\Product;
use App\Application\Model\State;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\ProductInterface;
use Yajra\Datatables\Request;
use Alert;

class ProductController extends AbstractController
{
    protected $productInterface;
    public function __construct(Product $model , ProductInterface $productInterface)
    {
        parent::__construct($model);
        $this->productInterface = $productInterface;
    }

    public function index(ProductsDataTable $dataTable){
        return $dataTable->render('admin.product.index');
    }

    public function show($id = null){
        $data = $this->productInterface->getData($id);
        return $this->createOrEdit('admin.product.edit' , $id  , ['data' => $data]);
    }

    public function store($id = null , \Illuminate\Http\Request $request){
         return $this->storeOrUpdate($request , $id , 'admin/product');
    }

    public function getById($id){
        $fields = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $this->createOrEdit('admin.product.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/product')->with('sucess' , 'Done Delete product From system');
    }

    public function getUser(\Illuminate\Http\Request $request){
        $users = User::where('name' , 'like' , '%'.$request->q.'%')->select('id' , 'name')->get();
        $total = $users->count();
        $data = [
            'items' => $users,
            'total' => $total
        ];
        return json_encode($data);
    }


    public function getState($id){
        $state =  State::where('country_id' , $id)->pluck('name' , 'id')->all();
        return json_encode(transformSelect($state));
    }
}
