<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogParameterValuesRequest;
use App\Http\Controllers\Controller;
use App\CatalogParameterValue;
use App\CatalogParameterCategory;

class CatalogparametervaluesController extends Controller
{
    /**
     * @param $id
     * @return $this
     */
    public function index($id)
    {
        return view('admin.catalog.parametervalues.index')->with('id', $id);
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
     * @param $id
     * @return $this
     */
    public function create($id)
    {
        return view('admin.catalog.parametervalues.create_edit')->with('id_category', $id);
    }

    /**
     * @param CatalogParameterValue $catalogparametervalue
     * @return $this
     */
    public function edit(CatalogParameterValue $catalogparametervalue)
    {
        $id_category = $catalogparametervalue->id_category;
        return view('admin.catalog.parametervalues.create_edit')->with(compact('catalogparametervalue', 'id_category'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function category($id)
    {
        $parametercategory = CatalogParameterCategory::where('id', $id)->first();
        return view('admin.catalog.parametervalues.parametercategory')->with(compact('parametercategory'));
    }

    /**
     * @param CatalogParameterValuesRequest $request
     * @param CatalogParameterValue $catalogParameterValue
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogParameterValuesRequest $request, CatalogParameterValue $catalogParameterValue)
    {
        $catalogParameterValue->name = $request->input('name');
        $catalogParameterValue->id_category = $request->input('id_category');
        $catalogParameterValue->updated_at = \Carbon::now();
        $catalogParameterValue->save();

        return redirect('admin/catalog/models/' . $catalogParameterValue->id . '/edit')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogParameterValuesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogParameterValuesRequest $request)
    {
        $catalogParameterValue = CatalogParameterValue::create($request->except('_token'));
        $catalogParameterValue->save();

        return redirect('admin/catalog/parametervalues/category/' . $request->id_category)->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogParameterValue $catalogParameterValue
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogParameterValue $catalogParameterValue)
    {
        if ($request->ajax()) {
            $catalogParameterValue->delete();
            return response()->json(['success' => 'Параметр удален']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
