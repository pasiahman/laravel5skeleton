<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Termmetas;
use App\Http\Models\Terms;
use App\Http\Requests\Backend\Terms\StoreRequest;
use App\Http\Requests\Backend\Terms\UpdateRequest;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Categories;
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

        return view('backend/terms/index', $data);
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
        return view('backend/terms/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $term = $this->model;
        $attributes['parent_id'] = $request->input('parent_id');
        foreach (config('app.languages') as $languageCode => $languageName) {
            $attributes[$languageCode] = $request->input();
        }
        $term->fill($attributes)->save();
        (new Termmetas)->sync($request->input('termmetas'), $term->id);
        flash(__('cms.data_has_been_created'))->success()->important();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('backend/terms/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $term = $this->model::findOrFail($id);
        $attributes['parent_id'] = $request->input('parent_id');
        $attributes[$request->input('locale')] = $request->input();
        $term->fill($attributes)->save();
        (new Termmetas)->sync($request->input('termmetas'), $term->id);
        flash(__('cms.data_has_been_updated'))->success()->important();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $category = $this->model::findOrFail($id);
        $category->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
