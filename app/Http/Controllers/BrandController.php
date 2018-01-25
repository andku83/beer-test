<?php

namespace App\Http\Controllers;

use App\Beer;
use App\BeerType;
use App\Brand;
use App\Http\Requests\BrandRequest;
use Collective\Html\HtmlFacade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Zofe\Rapyd\DataGrid\Row;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $source = Brand::withCount('beers');
        $filter = $this->getFilter($source);
        $grid = $this->getGrid($filter);
        return view('brand.index', compact('filter', 'grid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        Brand::create($request->all());

        return redirect(route('brand.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Brand::findOrFail($id);

        return view('brand.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Brand::findOrFail($id);

        return view('brand.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BrandRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $model = Brand::findOrFail($id);
        $model->update($request->all());

        return redirect(route('brand.index'));
    }

    /**
     * Toggle status the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id)
    {
        $model = Brand::findOrFail($id);
        $model->toggle();

        return redirect(route('brand.index'));
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
            Brand::destroy($id);
            request()->session()->flash('alert', ['class' => 'success', 'message' => 'Brand deleted']);
        } catch (\Exception $e) {
            request()->session()->flash('alert', ['class' => 'danger', 'message' => 'Brand can\'t deleted']);
        }

        return redirect(route('brand.index'));
    }

    protected function getGrid($filter)
    {
        $grid = \DataGrid::source($filter);

        $grid->add('brand.name','Name', true)
            ->cell(function ($value, Brand $model) {
                return HtmlFacade::link("brand/{$model->id}/edit", $model->name);
            });
        $grid->add('beers_count', 'Count Beers', true);
        $grid->add('status', 'Status', true)
            ->cell(function ($value, Brand $model) {
                return HtmlFacade::link("brand/{$model->id}/toggle", $model->getStatus());
            });
        $grid->edit('/brand', __('Actions'), 'show|edit|destroy')
            ->cell(function (View $value, Brand $model) {
                return view('datagrid.actions', $value->getData());
            });

        $grid->row(function (Row $row) {
            $row->attributes['class'] = "status-{$row->data->status}";
        });

        $grid->link('/brand/create',"Add New", "TR", ['class' => 'btn btn-success']);
        $grid->orderBy('name','asc');
        $grid->paginate(4);

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

        $filter->add('type_id', 'Type', 'select')
            ->options([null => 'Type'] + BeerType::orderBy('name')->pluck('name', 'id')->toArray())
            ->scope(function (Builder $query, $value) {
                if ($value)
                    $query->whereIn('id', Beer::whereTypeId($value)->select('brand_id'));
//                    $query->join('beers', 'beers.brand_id', '=', 'brands.id')  // error with groupBy
//                        ->where('beers.type_id', $value);                      // or duplicate values without groupBy
                return $query;
            });

        $filter->submit('search');
        $filter->reset('reset');

        return $filter;
    }
}
