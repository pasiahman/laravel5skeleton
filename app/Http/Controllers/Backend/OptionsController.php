<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Options;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['options'] = Options::search($request->query())->paginate($request->query('limit'));

        return view('backend/options/index', $data);
    }

    public function create(Request $request)
    {
        $data['option'] = $option = new Options;

        if ($request->input('create')) {
            $validator = $option->validate($request->input(), 'create');
            if ($validator->passes()) {
                $option->fill($request->input())->save();
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendOptions');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/options/create', $data);
    }

    public function delete($id)
    {
        $option = Options::search($id)->firstOrFail();

        $option->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['option'] = $option = Options::search(['id' => $request->input('id')])->firstOrFail();

        if ($request->input('update')) {
            $validator = $option->validate($request->input(), 'update');
            if ($validator->passes()) {
                $option->fill($request->input())->save();
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendOptions');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/options/update', $data);
    }
}
