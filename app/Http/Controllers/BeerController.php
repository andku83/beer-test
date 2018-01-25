<?php

namespace App\Http\Controllers;

use App\Beer;
use App\BeerType;
use App\Brand;
use App\Http\Requests\BeerRequest;
use Collective\Html\HtmlFacade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Zofe\Rapyd\DataGrid\Row;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $source = Beer::with(['brand', 'type']);
        $filter = $this->getFilter($source);
        $grid = $this->getGrid($filter);
        return view('beer.index', compact('filter', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BeerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeerRequest $request)
    {
        Beer::create($request->all());

        return redirect(route('beer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Beer::findOrFail($id);

        return view('beer.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Beer::findOrFail($id);

        return view('beer.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BeerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeerRequest $request, $id)
    {
        $model = Beer::findOrFail($id);
        $model->update($request->all());

        return redirect(route('beer.index'));
    }

    /**
     * Toggle status the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id)
    {
        $model = Beer::findOrFail($id);
        $model->toggle();

        return redirect(route('beer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Beer::destroy($id);
            request()->session()->flash('alert', ['class' => 'success', 'message' => 'Beer deleted']);
        } catch (\Exception $e) {
            request()->session()->flash('alert', ['class' => 'danger', 'message' => 'Beer can\'t deleted']);
        }

        return redirect(route('beer.index'));
    }
    
    protected function getGrid($source)
    {
        $grid = \DataGrid::source($source);

        $grid->add('name', 'Name', true)
            ->cell(function ($value, Beer $model) {
                return HtmlFacade::link("beer/{$model->id}/edit", $model->name);
            });
        $grid->add('brand.name', 'Brand', true);
        $grid->add('type.name', 'Type', true);
        $grid->add('status', 'Status', true)
            ->cell(function ($value, Beer $model) {
                return HtmlFacade::link("beer/{$model->id}/toggle", $model->getStatus());
            });
        $grid->edit('/beer', __('Actions'), 'show|edit|destroy')
            ->cell(function (View $value, Beer $model) {
                return view('datagrid.actions', $value->getData());
            });

        $grid->row(function (Row $row) {
            $row->attributes['class'] = "status-{$row->data->status}";
        });

        $grid->link('/beer/create',"Add New", "TR", ['class' => 'btn btn-success']);
        $grid->orderBy('name','asc');
        $grid->paginate(10);

        return $grid;
    }

    /**
     * @param Builder $source
     * @return \DataFilter
     */
    protected function getFilter(Builder $source)
    {
        $filter = \DataFilter::source($source);

        $filter->add('name','Name', 'text');

        $filter->add('brand_id', 'Brand', 'select')
            ->options([null => 'Brand'] + Brand::orderBy('name')->pluck('name', 'id')->toArray());
        $filter->add('type_id', 'Type', 'select')
            ->options([null => 'Type'] + BeerType::orderBy('name')->pluck('name', 'id')->toArray());

        $filter->submit('search');
        $filter->reset('reset');

        return $filter;
    }
}
