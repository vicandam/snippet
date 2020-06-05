<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request;

        $categories = new Category();

        if(! empty($input['searchBy'])) {

            $searchBy        = ! empty($input['searchBy'])   ? $input['searchBy'] : null;
            $paginate        = ! empty($input['paginate'])   ? $input['paginate'] : null;
            $page            = ! empty($input['page'])       ? $input['page'] : null;

            if($searchBy == 'filter') {
                $categories = $categories->filterSearch($input);
            }

            $categories = $categories->paginate($input['paginate']);
        } else {
            $categories = $categories->get();
        }

        $result = [
            'data' => [
                'categories'     => $categories,
                'category_count' => $categories->count($categories)
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $input = $request;

        $category = new Category();

        $faker = \Faker\Factory::create();

        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            $path            = $request->file('image')->storeAs('public/avatars', $fileNameToStore);
        } else {

        }

        $category->name = $input['name'];
        $category->image = isset($fileNameToStore) ? $fileNameToStore : 'no-image.png';

        $category->save();

        $result = [
            'message' => 'Category added successfully',
            'data' => [
                'category' => $category
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }

    public function imageUpload(Request $request)
    {
        request()->validate([
            'fileUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($files = $request->file('fileUpload')) {
            $destinationPath = 'public/image/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
        }

        return Redirect::to("image")
            ->withSuccess('Great! Image has been successfully uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $input = $request;

        $category->name = $input['name'];

        $category->save();

        $result = [
            'message' => 'Category updated successfully',
            'data' => [
                'category' => $category
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return 'true';
    }

    public function getAllCategory(Category $categories)
    {
        $categories = $categories->all();

        $result = [
            'data' => [
                'categories'     => $categories,
                'category_count' => $categories->count($categories)
            ]
        ];

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }
}
