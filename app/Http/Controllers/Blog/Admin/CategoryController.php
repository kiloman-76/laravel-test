<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest  $request, $id)
    {

//        $rules = [
//            'title' => 'required|min:5|max:200',
//            'slug' => 'max:200',
//            'description' => 'string|min:3|max:500',
//            'parent_id' => 'required|integer|exists:blog_categories,id'
//        ];

//        $validatedData = $this->validate($request, $rules);

//        $validatedData = $request->validate($rules);

//        $validator = \Validator::make($request->all(), $rules);
//        $validatedData[] = $validator->passes(); //Выполнит проверку вернет true/false, можно прикрутить доп. действия
//        $validatedData[] = $validator->validate(); //Редиректит в случае ошибки
//        $validatedData[] = $validator->valid(); // Возвращает только правильные поля
//        $validatedData[] = $validator->failed(); // Возвращает только идентификаторы не прошедших валидацию полей вместе с ошибками
//        $validatedData[] = $validator->errors(); // Возвращает ошибки
//        $validatedData[] = $validator->fails(); //возвращает true если валидация провалилась

        dd($validatedData);

        $item = BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);

        }

        $data = $request->all();
        $result = $item->fill($data)->save();

        if($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']); //Добавление в сессию переменной success для дальнейшего его вывода
        } else {
            return redirect()
                ->withErrors(['msg' => 'Ошибка соединения'])
                ->withInput();
        }
    }

}
