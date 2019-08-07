<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;

/**
 * Управление статьями блога
 * 
 * @package App\Http\Controllers\Blog\Admin
 */

class PostController extends BaseController
{

    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    
    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        $item = (new BlogCategory())->create($data);

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return redirect()->withErrors(['msg'=> 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {

        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
              ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
              ->withInput();

        }

        $data = $request->all();
        
        /* Ушло в обсервер
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['title']);
        }
        if (empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        } */

        $result = $item->update($data);

        if ($result) {
          return redirect()
            ->route('blog.admin.posts.edit', $item->id)
            ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
              ->withErrors(['msg' => 'Ошибка сохранения'])
              ->withInput();
        }
    }

    /**
     * Удалить
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      dd(__METHOD__, $id, request()->all());
    }
}

