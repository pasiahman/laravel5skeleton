<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Options;
use App\Http\Requests\Backend\Options\StoreRequest;
use App\Http\Requests\Backend\Options\UpdateRequest;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['options'] = Options::search($request->query())->paginate($request->query('limit'));

        if ($request->query('action')) { (new Options)->action($request->query()); return redirect()->back(); }

        return view('backend/options/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['option'] = $option = new Options;
        return view('backend/options/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Options::create($request->input());
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
    public function edit($id)
    {
        $data['option'] = Options::findOrFail($id);
        return view('backend/options/edit', $data);
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
        $option = Options::findOrFail($id);
        $option->fill($request->input())->save();
        flash(__('cms.data_has_been_updated'))->success()->important();
        return redirect()->back();
    }

    public function delete($id)
    {
        $option = Options::findOrFail($id);
        $option->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
