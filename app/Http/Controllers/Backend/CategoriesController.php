<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Categories;
use App\Http\Requests\Backend\Categories\StoreRequest;
use App\Http\Requests\Backend\Categories\UpdateRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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

        $data['categories'] = Categories::search($request->query())->paginate($request->query('limit'));
        $data['parent_options'] = (new Categories)->getParentOptions();

        if ($request->query('action')) { (new Categories)->action($request->query()); return redirect()->back(); }

        return view('backend/categories/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = $category = new Categories;
        $data['category_translation'] = $category;
        $data['parent_options'] = (new Categories)->getParentOptions();
        return view('backend/categories/create', $data);
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
        Categories::create($attributes);
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
        $data['category'] = $category = Categories::findOrFail($id);
        $data['category_translation'] = $category->translateOrNew($request->query('locale'));
        $data['parent_options'] = (new Categories)->getParentOptions();
        return view('backend/categories/update', $data);
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
        $category = Categories::findOrFail($id);
        $attributes = ['parent_id' => $request->input('parent_id'), $request->input('locale') => $request->input()];
        $category->fill($attributes)->save();
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
        $category = Categories::findOrFail($id);
        $category->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
