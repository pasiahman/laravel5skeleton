<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Categories;
use App\Http\Models\Posts;
use App\Http\Models\Postmeta;
use App\Http\Requests\Backend\Posts\StoreRequest;
use App\Http\Requests\Backend\Posts\UpdateRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->query('locale') ?: $request->query->set('locale', config('app.locale'));
        $request->query('sort') ?: $request->query->set('sort', 'updated_at,DESC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['model'] = $model = new Posts;
        $data['posts'] = Posts::select((new Posts)->getTable().'.*')->search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Posts)->action($request->query()); return redirect()->back(); }

        return view('backend/posts/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['post'] = $post = new Posts;
        $data['post_translation'] = $post;
        return view('backend/posts/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $post = new Posts;
        $attributes = collect($request->input())->only($post->getFillable())->toArray();
        $attributes['author_id'] = auth()->user()->id;
        $attributes[$request->input('locale')] = $request->input();
        $post->fill($attributes)->save();
        (new Postmeta)->sync($request->input('postmeta'), $post->id);
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
        $data['post'] = $post = Posts::findOrFail($id);
        $data['post_translation'] = $post->translateOrNew($request->query('locale'));
        return view('backend/posts/update', $data);
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
        $post = Posts::findOrFail($id);
        $attributes = collect($request->input())->only($post->getFillable())->toArray();
        $attributes['author_id'] = auth()->user()->id;
        $attributes[$request->input('locale')] = $request->input();
        $post->fill($attributes)->save();
        (new Postmeta)->sync($request->input('postmeta'), $post->id);
        flash(__('cms.data_has_been_updated'))->success()->important();
        if ($post->status == 'trash' && ! auth()->user()->can('backend posts trash')) { return redirect()->route('backend.posts.index'); }
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
        $post = Posts::findOrFail($id);
        $post->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }

    public function trash($id)
    {
        $post = Posts::findOrFail($id);
        $post->fill(['status' => 'trash'])->save();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
