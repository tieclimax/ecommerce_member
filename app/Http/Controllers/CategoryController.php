<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::getMyCategory();
        // return $category;
        return view('backend.category.index')->with('categories', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('backend.category.create')->with('parent_cats', $parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'owner_id' => 'required',
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'photo' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'is_parent' => 'sometimes|in:1',
            'is_featured' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $data = $request->all();
        $slug = $request->title;
        $count = Category::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('Y-m-d') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;

        $data['is_parent'] = $request->input('is_parent', 0);

        $status = Category::create($data);
        if ($status) {
            request()->session()->flash('success', 'เพิ่มหมวดหมู่สำเร็จ');
        } else {
            request()->session()->flash('error', 'เพิ่มหมวดหมู่ไม่สำเร็จ!');
        }
        return redirect()->route('category.index');
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
        $parent_cats = Category::where('is_parent', 1)->get();
        $category = Category::findOrFail($id);
        return view('backend.category.edit')->with('category', $category)->with('parent_cats', $parent_cats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'photo' => 'string|nullable',
            'status' => 'required|in:active,inactive',
            'is_parent' => 'sometimes|in:1',
            'is_featured' => 'required|in:active,inactive',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->all();

        $data['is_parent'] = $request->input('is_parent', 0);

        $status = $category->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'อัปเดตหมวดหมู่สำเร็จ');
        } else {
            request()->session()->flash('error', 'อัปเดตหมวดหมู่ไม่สำเร็จ!');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $child_cat_id = Category::where('parent_id', $id)->pluck('id');
        // return $child_cat_id;
        $status = $category->delete();

        if ($status) {
            if (count($child_cat_id) > 0) {
                Category::shiftChild($child_cat_id);
            }
            request()->session()->flash('success', 'ลบหมวดหมู่สำเร็จ');
        } else {
            request()->session()->flash('error', 'ลบหมวดหมู่ไม่สำเร็จ');
        }
        return redirect()->route('category.index');
    }

    public function getChildByParent(Request $request)
    {
        // return $request->all();
        $category = Category::findOrFail($request->id);
        $child_cat = Category::getChildByParentID($request->id);
        // return $child_cat;
        if (count($child_cat) <= 0) {
            return response()->json(['status' => false, 'msg' => '', 'data' => null]);
        } else {
            return response()->json(['status' => true, 'msg' => '', 'data' => $child_cat]);
        }
    }
}
