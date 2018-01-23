<?php

namespace App\Http\Controllers;

use App\BeerType;
use App\Http\Requests\BeerTypeRequest;
use Collective\Html\HtmlFacade;
use Illuminate\View\View;

class BeerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = $this->getGrid(BeerType::withCount('beers'));

        return view('beer_type.index', ['grid' => $grid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beer_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BeerTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeerTypeRequest $request)
    {
        BeerType::create($request->all());

        return redirect(route('beer_type.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = BeerType::findOrFail($id);

        return view('beer_type.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = BeerType::findOrFail($id);

        return view('beer_type.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BeerTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeerTypeRequest $request, $id)
    {
        $model = BeerType::findOrFail($id);
        $model->update($request->all());

        return redirect(route('beer_type.index'));
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
            BeerType::destroy($id);
            request()->session()->flash('alert', ['class' => 'success', 'message' => 'BeerType deleted']);
        } catch (\Exception $e) {
            request()->session()->flash('alert', ['class' => 'danger', 'message' => 'BeerType can\'t deleted']);
        }

        return redirect(route('beer_type.index'));
    }
    
    protected function getGrid($souce)
    {
        $grid = \DataGrid::source($souce);

        $grid->add('name', 'Name', true)
            ->cell(function ($value, BeerType $model) {
                return HtmlFacade::link("beer_type/{$model->id}/edit", $model->name);
            });
        $grid->add('beers_count','Count Beers', true);
        $grid->edit('/beer_type', __('Actions'),'show|edit|destroy')
            ->cell(function(View $value, BeerType $model) {
                return view('datagrid.actions', $value->getData());
            });


        $grid->link('/beer_type/create',"Add New", "TR", ['class' => 'btn btn-success']);
        $grid->orderBy('name','asc');
        $grid->paginate(5);

        return $grid;
    }
}
