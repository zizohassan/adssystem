<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CountrysDataTable;
use App\Application\Model\Country;
use Yajra\Datatables\Request;
use Alert;

class CountryController extends AbstractController
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function index(CountrysDataTable $dataTable){
        return $dataTable->render('admin.country.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.country.edit' , $id);
    }

    public function store($id = null , \Illuminate\Http\Request $request){
         return $this->storeOrUpdate($request , $id , 'admin/country');
    }

    public function getById($id){
        $fields = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $this->createOrEdit('admin.country.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/country')->with('sucess' , 'Done Delete country From system');
    }
}
