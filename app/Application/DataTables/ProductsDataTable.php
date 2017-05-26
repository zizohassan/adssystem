<?php

namespace App\Application\DataTables;

use App\Application\Model\Product;
use Yajra\Datatables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
             ->eloquent($this->query())
             ->addColumn('edit', 'admin.product.buttons.edit')
             ->addColumn('delete', 'admin.product.buttons.delete')
             ->addColumn('view', 'admin.product.buttons.view')
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Product::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters($this->getBuilderParameters());
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $array = [
              [
                  'name' => "id",
                  'data' => 'id',
                  'title' => adminTrans('curd' , 'id'),
             ],
             [
                'name' => "name",
                'data' => 'name',
                'title' => adminTrans('product' , 'name'),
             ],
            [
                'name' => "price",
                'data' => 'price',
                'title'  => adminTrans('product' , 'price'),
            ],
             [
                  'name' => 'view',
                  'data' => 'view',
                  'title' => adminTrans('curd' , 'view'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
             [
                  'name' => 'edit',
                  'data' => 'edit',
                  'title' =>  adminTrans('curd' , 'edit'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
             [
                   'name' => 'delete',
                   'data' => 'delete',
                   'title' => adminTrans('curd' , 'delete'),
                   'exportable' => false,
                   'printable' => false,
                   'searchable' => false,
                   'orderable' => false,
             ],
        ];

        if(auth()->user()->group_id == 5){
          return  array_except($array , 5);
        }
        return $array;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Productdatatables_' . time();
    }
}