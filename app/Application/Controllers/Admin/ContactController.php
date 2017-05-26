<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\ContactsDataTable;
use App\Application\Model\Contact;
use Yajra\Datatables\Request;
use Alert;

class ContactController extends AbstractController
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function index(ContactsDataTable $dataTable){
        return $dataTable->render('admin.contact.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.contact.edit' , $id);
    }

    public function store($id = null , \Illuminate\Http\Request $request){
         return $this->storeOrUpdate($request , $id , 'admin/contact');
    }

    public function getById($id){
        $fields = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $this->createOrEdit('admin.contact.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/contact')->with('sucess' , 'Done Delete contact From system');
    }
}
