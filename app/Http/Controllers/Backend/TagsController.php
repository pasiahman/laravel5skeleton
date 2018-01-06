<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Tags;
use App\Http\Models\Termmeta;
use App\Http\Requests\Backend\Tags\StoreRequest;
use App\Http\Requests\Backend\Tags\UpdateRequest;
use Illuminate\Http\Request;

class TagsController extends Controller
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

        $data['tags'] = Tags::search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Tags)->action($request->query()); return redirect()->back(); }

        return view('backend/tags/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tag'] = $tag = new Tags;
        $data['tag_translation'] = $tag;
        return view('backend/tags/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $attributes = [$request->input('locale') => $request->input()];
        $tag = Tags::create($attributes);
        (new Termmeta)->sync($request->input('termmeta'), $tag->id);
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
        $data['tag'] = $tag = Tags::findOrFail($id);
        $data['tag_translation'] = $tag->translateOrNew($request->query('locale'));
        return view('backend/tags/update', $data);
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
        $tag = Tags::findOrFail($id);
        $attributes = [$request->input('locale') => $request->input()];
        $tag->fill($attributes)->save();
        (new Termmeta)->sync($request->input('termmeta'), $tag->id);
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
        $tag = Tags::findOrFail($id);
        $tag->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
