<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\TermsController;
use App\Http\Models\MediumCategories;
use App\Http\Models\Termmetas;
use Illuminate\Http\Request;

class MediumCategoriesController extends TermsController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MediumCategories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->query('locale') ?: $request->query->set('locale', config('app.locale'));
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['categories'] = $this->model::search($request->query())->paginate($request->query('limit'));
        $data['model'] = $this->model;

        if ($request->query('action')) { $this->model->action($request->query()); return redirect()->back(); }

        return view('backend/medium_categories/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['term'] = $this->model;
        $data['term_translation'] = $this->model;
        return view('backend/medium_categories/create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $data['term'] = $term = $this->model::findOrFail($id);
        $data['term_translation'] = $term->translateOrNew($request->query('locale'));
        return view('backend/medium_categories/edit', $data);
    }
}
