<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Allcontroller
{
    public function destroy($id)
    {
        $model = $this->model;
        $model->destroy($id);
    }
    public function index()
    {
        $model = $this->model;
        $table_name = $this->model->getTable();
        $view = $table_name .'.index';
        return view($view);
    }
    public function create()
    {
        $model = $this->model;
        $table_name = $this->model->getTable();
        $view = $table_name .'.create';
        return view($view);
    }
}
