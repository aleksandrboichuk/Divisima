<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CategoryController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $this->canSee('content');

        $this->setBreadcrumbs($this->getBreadcrumbs());

        return view('admin.category.index',[
            'categories' => Category::query()->orderBy('id', 'desc')->get(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Get the breadcrumbs array
     *
     * @return array[]
     */
    protected function getBreadcrumbs(): array
    {
        $breadcrumbs = parent::getBreadcrumbs();

        $breadcrumbs[] = ["Категорії"];

        return $breadcrumbs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $this->canCreate('content');

        $this->setBreadcrumbs($this->getCreateOrEditPageBreadcrumbs('categories',true));

        return view('admin.category.add',[
            'category_groups' => CategoryGroup::getActiveEntries(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CategoryRequest $request): Redirector|RedirectResponse|Application
    {
        $this->canCreate('content');

        $request->setActiveField();

        $category = Category::query()->create($request->all());

        return redirect('/admin/categories')->with(['success-message' => 'Категорію успішно додано.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $this->canEdit('content');

        $category =  Category::query()->find($id);

        if(!$category){
            abort(404);
        }

        $this->setBreadcrumbs($this->getCreateOrEditPageBreadcrumbs('categories',false));

        return view('admin.category.edit',[
            'category' => $category,
            'category_groups' => CategoryGroup::all(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     *  Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(CategoryRequest $request, int $id): Redirector|RedirectResponse|Application
    {
        $this->canEdit('content');

        $category = Category::query()->find($id);

        $request->setActiveField();

        $active = $request->get('active');

        if($category->active != $active){
            $this->setActiveFieldToModelRelations($category, $active, ['products']);
        }

        $category->update($request->all());

        return redirect("/admin/categories")->with(['success-message' => 'Категорію успішно змінено.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $this->canDelete('content');

        $category = Category::query()->find($id);

        if(!$category){
            abort(404);
        }

        $category->delete();

        return redirect("/admin/categories")->with(['success-message' => 'Категорію успішно видалено.']);
    }
}
