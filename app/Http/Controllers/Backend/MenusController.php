<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\TermsController;
use App\Http\Models\Categories;
use App\Http\Models\Menus;
use App\Http\Models\Posts;
use App\Http\Models\Termmetas;
use Illuminate\Http\Request;

class MenusController extends TermsController
{
    protected $model;

    public function __construct()
    {
        $this->model = new Menus;
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

        $data['model'] = $this->model;
        $data['terms'] = $this->model::search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { $this->model->action($request->query()); return redirect()->back(); }

        return view('backend/menus/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['post'] = new Posts;
        $data['posts'] = Posts::where('status', 'publish')->get();
        $data['term'] = $this->model;
        $data['term_translation'] = $this->model;
        return view('backend/menus/create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $data['post'] = new Posts;
        $data['posts'] = Posts::where('status', 'publish')->get();
        $data['term'] = $term = $this->model::findOrFail($id);
        $data['term_translation'] = $term->translateOrNew($request->query('locale'));
        return view('backend/menus/edit', $data);
    }
}
