<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
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

    public function create(Request $request)
    {
        $data['category'] = $category = new Categories;
        $data['category_translation'] = $category;
        $data['parent_options'] = (new Categories)->getParentOptions();

        if ($request->input('create')) {
            $validator = $category->validate($request->input(), 'create');
            if ($validator->passes()) {
                $fill = ['parent_id' => $request->input('parent_id'), $request->input('locale') => $request->input()];
                $category->fill($fill)->save();
                flash(__('cms.data_has_been_created'))->success()->important();
                return redirect()->route('backendCategories');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/categories/create', $data);
    }

    public function delete($id)
    {
        $category = Categories::search(['id' => $id])->firstOrFail();

        $category->delete();
        flash(__('cms.data_has_been_deleted'))->success()->important();
        return back();
    }

    public function update(Request $request)
    {
        $data['category'] = $category = Categories::search(['id' => $request->input('id')])->firstOrFail();
        $data['category_translation'] = $category->translateOrNew($request->input('locale'));
        $data['parent_options'] = (new Categories)->getParentOptions();

        if ($request->input('update')) {
            $validator = $category->validate($request->input(), 'update');
            if ($validator->passes()) {
                $fill = ['parent_id' => $request->input('parent_id'), $request->input('locale') => $request->input()];
                $category->fill($fill)->save();
                flash(__('cms.data_has_been_updated'))->success()->important();
                return redirect()->route('backendCategories');
            } else {
                $message = implode('<br />', $validator->errors()->all()); flash($message)->error()->important();
                $data['errors'] = $validator->errors();
            }
        }

        return view('backend/categories/update', $data);
    }
}
