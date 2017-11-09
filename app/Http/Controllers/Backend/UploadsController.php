<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Uploads;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'name,ASC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['request'] = $request;
        $data['uploads'] = Uploads::search($request->query())->paginate($request->query('limit'));

        return view('backend/uploads/index', $data);
    }

    public function create(Request $request)
    {
        $data['upload'] = $upload = new Uploads;

        if ($request->input('create')) {
            $validator = $upload->validate($request->input(), 'create');
            if ($validator->passes()) {
                $upload->fill($request->input())->save();
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendUploads');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/uploads/create', $data);
    }

    public function delete($id)
    {
        $upload = Uploads::find($id) ?: abort(404);

        $upload->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['upload'] = $upload = Uploads::find($request->input('id'));

        if ($request->input('update')) {
            $validator = $upload->validate($request->input(), 'update');
            if ($validator->passes()) {
                $upload->fill($request->input())->save();
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendUploads');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/uploads/update', $data);
    }
}
