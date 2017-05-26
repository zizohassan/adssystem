<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\StatesDataTable;
use App\Application\Model\Country;
use App\Application\Model\State;
use Yajra\Datatables\Request;
use Alert;

class StateController extends AbstractController
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    public function index(StatesDataTable $dataTable){
        return $dataTable->render('admin.state.index');
    }

    public function show($id = null){
        $country = transformSelect(Country::pluck('name' , 'id')->all());
        return $this->createOrEdit('admin.state.edit' , $id ,  ['country' => $country]);
    }

    public function store($id = null , \Illuminate\Http\Request $request){
         return $this->storeOrUpdate($request , $id , 'admin/state');
    }

    public function getById($id){
        $fields = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $this->createOrEdit('admin.state.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/state')->with('sucess' , 'Done Delete state From system');
    }
}
