<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Media;
use App\Http\Models\Postmeta;
use App\Http\Requests\Backend\Media\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $request->query('sort') ?: $request->query->set('sort', 'created_at,DESC');
        $request->query('limit') ?: $request->query->set('limit', 10);

        $data['action_options'] = (new Media)->getStatusOptions();
        $data['media'] = Media::search($request->query())->paginate($request->query('limit'));
        $data['mime_type_options'] = (new Media)->mime_type_options;
        $data['status_options'] = (new Media)->status_options;

        if ($request->query('action')) { (new Media)->action($request->query()); return redirect()->back(); }

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

    public function store(Request $request)
    {
        if ($file = $request->file('qqfile')) {
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $medium = Media::create(['author' => auth()->user()->id, 'title' => $filename, 'name' => str_slug($filename), 'mime_type' => $file->getMimeType()]);
            $originalPath = 'media/original/'.$medium->id.'/'.str_slug($filename).'.'.$extension;
            $thumbnailPath = 'media/thumbnail/'.$medium->id.'/'.str_slug($filename).'.'.$extension;
            $file->storeAs('', $originalPath);

            $medium->setAttachedFile($originalPath);
            $thumbnailPath = $medium->setAttachedFileThumbnail($originalPath, $thumbnailPath);

            Postmeta::create(['post_id' => $medium->id, 'key' => 'attached_file', 'value' => $originalPath]);
            Postmeta::create(['post_id' => $medium->id, 'key' => 'attached_file_thumbnail', 'value' => $thumbnailPath]);
            Postmeta::create(['post_id' => $medium->id, 'key' => 'attachment_metadata', 'value' => json_encode(['extension' => $extension, 'size' => $file->getClientSize()])]);
        }

        return response()->json(['success' => true, 'thumbnailUrl' => Storage::url($thumbnailPath)]);
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
        $data['medium'] = Media::search(['id' => $id])->firstOrFail();
        return view('backend/media/update', $data);
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
        $request->merge(['name' => str_slug($request->input('title'))]);
        $medium = Media::search(['id' => $id])->firstOrFail();
        $medium->fill($request->input())->save();
        flash(__('cms.data_has_been_updated'))->success()->important();
        return redirect()->back();
    }

    public function delete($id)
    {
        $medium = Media::search(['id' => $id])->firstOrFail();
        $medium->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return redirect()->back();
    }
}
