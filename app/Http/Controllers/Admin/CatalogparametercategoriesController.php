<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CatalogParameterCategoryRequest;
use App\Http\Controllers\Controller;
use App\CatalogParameterCategory;

class CatalogparametercategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.catalog.parametercategories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.catalog.parametercategories.create_edit');
    }

    /**
     * @param CatalogParameterCategory $parametercategory
     * @return $this
     */
    public function edit(CatalogParameterCategory $parametercategory)
    {
        return view('admin.catalog.parametercategories.create_edit')->with(compact('parametercategory'));
    }

    /**
     * @param CatalogParameterCategoryRequest $request
     * @param CatalogParameterCategory $parameterCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogParameterCategoryRequest $request, CatalogParameterCategory $parameterCategory)
    {
        $parameterCategory->name = $request->input('name');
        $parameterCategory->updated_at = \Carbon::now();
        $parameterCategory->save();

        return redirect('admin/catalog/parametercategories/' . $parameterCategory->id . '/edit')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogParameterCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogParameterCategoryRequest $request)
    {
        $parameterCategory = CatalogParameterCategory::create($request->except('_token'));
        $parameterCategory->save();

        return redirect('admin/catalog/parametercategories/')->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogParameterCategory $parameterCategory
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogParameterCategory $parameterCategory)
    {
        if ($request->ajax()) {

            $parameterCategory->delete();

            return response()->json(['success' => 'Категория удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
