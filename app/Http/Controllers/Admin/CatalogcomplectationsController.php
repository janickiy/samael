<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogComplectationsRequest;
use App\Http\Controllers\Controller;
use App\CatalogComplectation;
use App\CatalogParameterCategory;

class CatalogcomplectationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        return view('admin.catalog.complectations.index')->with('id_model', $id);
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
    public function create($id)
    {
        $category_options[null] = 'Категория';
        $parameterCategories = CatalogParameterCategory::get()->toArray();

        foreach ($parameterCategories as $category) {
            $category_options[$category['id']] = $category['name'];
        }

        return view('admin.catalog.complectations.create_edit', compact('category_options'))->with('id_model', $id);
    }

    /**
     * @param CatalogComplectation $catalogcomplectation
     * @return $this
     */
    public function edit(CatalogComplectation $catalogcomplectation)
    {
        $id_model = $catalogcomplectation->id_model;

        $category_options[null] = 'Категория';
        $parameterCategories = CatalogParameterCategory::get()->toArray();

        foreach ($parameterCategories as $category) {
            $category_options[$category['id']] = $category['name'];
        }

        return view('admin.catalog.complectations.create_edit')->with(compact('catalogcomplectation', 'id_model', 'category_options'));
    }

    /**
     * @param CatalogComplectationsRequest $request
     * @param CatalogComplectation $catalogComplectation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogComplectationsRequest $request, CatalogComplectation $catalogComplectation)
    {
        $catalogComplectation->name = $request->input('name');
        $catalogComplectation->save();

        return redirect('admin/catalog/models/model/' . $catalogComplectation->id_model . '/complectations')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogComplectationsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogComplectationsRequest $request)
    {
        $carModification = CatalogComplectation::create($request->except('_token'));
        $carModification->save();

        return redirect('admin/catalog/models/model/' . $carModification->id_model . '/modifications')->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogComplectation $catalogComplectation
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogComplectation $catalogComplectation)
    {
        if ($request->ajax()) {
            $catalogComplectation->delete();
            return response()->json(['success' => 'Комплектация удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
