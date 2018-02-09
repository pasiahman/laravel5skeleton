<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\MediumCategories;
use App\Http\Models\Termmetas;
use App\Http\Requests\Backend\Categories\StoreRequest;
use App\Http\Requests\Backend\Categories\UpdateRequest;
use Illuminate\Http\Request;

class MediumCategoriesController extends Controller
{
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

        $data['categories'] = MediumCategories::search($request->query())->paginate($request->query('limit'));
        $data['model'] = new MediumCategories;

        if ($request->query('action')) { (new MediumCategories)->action($request->query()); return redirect()->back(); }

        return view('backend/medium_categories/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = $category = new MediumCategories;
        $data['category_translation'] = $category;
        return view('backend/medium_categories/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $attributes = ['parent_id' => $request->input('parent_id'), $request->input('locale') => $request->input()];
        $category = MediumCategories::create($attributes);
        (new Termmetas)->sync($request->input('termmetas'), $category->id);
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
        $data['category'] = $category = MediumCategories::findOrFail($id);
        $data['category_translation'] = $category->translateOrNew($request->query('locale'));
        return view('backend/medium_categories/update', $data);
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
        $category = MediumCategories::findOrFail($id);
        $attributes = ['parent_id' => $request->input('parent_id'), $request->input('locale') => $request->input()];
        $category->fill($attributes)->save();
        (new Termmetas)->sync($request->input('termmetas'), $category->id);
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
        $category = MediumCategories::findOrFail($id);
        $category->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
