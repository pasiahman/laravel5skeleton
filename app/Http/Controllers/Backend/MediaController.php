<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Media;
use App\Http\Models\Postmeta;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'created_at,DESC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['media'] = Media::search($request->query())->paginate($request->query('limit'));
        $data['mime_type_options'] = (new Media)->mime_type_options;
        $data['request'] = $request;

        return view('backend/media/index', $data);
    }

    public function create(Request $request)
    {
        $data['medium'] = $medium = new Media;

        if ($request->input('create')) {
            $validator = $medium->validate($request->input(), 'create');
            if ($validator->passes()) {
                $medium->fill($request->input())->save();
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendMedia');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/media/create', $data);
    }

    public function delete($id)
    {
        $medium = Media::find($id) ?: abort(404);

        $medium->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function store(Request $request)
    {
        if ($file = $request->file('qqfile')) {
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $medium = Media::create(['author' => auth()->user()->id, 'title' => $filename, 'name' => str_slug($filename), 'mime_type' => $file->getMimeType()]);
            $path = $medium->id.'/'.str_slug($filename).'.'.$extension;
            $file->storeAs('', $path, 'media');
            $medium->setAttachedFileThumbnailAttribute($path);

            Postmeta::create(['post_id' => $medium->id, 'key' => 'attached_file', 'value' => $path]);
            // dd($medum->attached_file_thumbnail);
            Postmeta::create(['post_id' => $medium->id, 'key' => 'attached_file_thumbnail', 'value' => 'media/'.$medium->id.'/'.str_slug($filename).'.'.$extension]);
            Postmeta::create(['post_id' => $medium->id, 'key' => 'attachment_metadata', 'value' => json_encode(['extension' => $extension, 'size' => $file->getClientSize()])]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $data['medium'] = $medium = Media::find($request->input('id'));

        if ($request->input('update')) {
            $validator = $medium->validate($request->input(), 'update');
            if ($validator->passes()) {
                $medium->fill($request->input())->save();
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendMedia');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/media/update', $data);
    }
}
