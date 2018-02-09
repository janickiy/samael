<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogComplectationsRequest;
use App\Http\Controllers\Controller;
use App\CatalogComplectation;
use App\CatalogParameterCategory;
use App\CatalogParameterComplectation;
use App\CatalogModification;
use App\CatalogParameterPack;
use App\CatalogParameterValue;
use App\CatalogParameterPackParameter;

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
        $modification_options[null] = 'Модификация';
        $modifications = CatalogModification::where('published', 1)->get()->toArray();

        foreach ($modifications as $modification) {
            $modification_options[$modification['id']] = $modification['name'];
        }

        $category_options[null] = 'Категория';
        $parameterCategories = CatalogParameterCategory::get()->toArray();

        foreach ($parameterCategories as $category) {
            $category_options[$category['id']] = $category['name'];
        }

        $equipment_options = [];
        $equipments = CatalogParameterValue::get()->toArray();

        foreach ($equipments as $equipment) {
            $equipment_options[$equipment['id']] = $equipment['name'];
        }

        return view('admin.catalog.complectations.create_edit', compact('category_options', 'modification_options', 'equipment_options'))->with('id_model', $id);
    }

    /**
     * @param CatalogComplectation $catalogcomplectation
     * @return $this
     */
    public function edit(CatalogComplectation $catalogcomplectation)
    {
        $modification_options[null] = 'Модификация';
        $modifications = CatalogModification::where('published', 1)->get()->toArray();

        foreach ($modifications as $modification) {
            $modification_options[$modification['id']] = $modification['name'];
        }

        $category_options[null] = 'Категория';
        $parameterCategories = CatalogParameterCategory::get()->toArray();

        foreach ($parameterCategories as $category) {
            $category_options[$category['id']] = $category['name'];
        }

        $equipment_options = [];
        $equipments = CatalogParameterValue::get()->toArray();

        $id_model = $catalogcomplectation->id_model;

        foreach ($equipments as $equipment) {
            $equipment_options[$equipment['id']] = isset($equipment['name']) ? $equipment['name'] : null;
        }

        $equipments = [];

        foreach (CatalogParameterComplectation::select(['id_parameter'])->where('id_complectation', $catalogcomplectation->id)->get()->toArray() as $row) {
            $equipments[] = $row['id_parameter'];
        }

        $catalogcomplectation->equipment = $equipments;

        $packs = [];

        foreach (CatalogParameterPack::where('id_complectation', $catalogcomplectation->id)->get()->toArray() as $row) {
            $id_parameter = [];

            foreach (CatalogParameterPackParameter::where('id_pack', $row['id'])->get()->toArray() as $row2) {
                $id_parameter[] = $row2['id_parameter'];
            }

            $row['equipment'] = $id_parameter;
            $packs[] = $row;
        }

        $catalogcomplectation->packs = $packs;

        //var_dump($packs);
       // exit;

        return view('admin.catalog.complectations.create_edit')->with(compact('catalogcomplectation', 'category_options', 'modification_options', 'equipment_options', 'id_model', 'packs'));
    }

    /**
     * @param CatalogComplectationsRequest $request
     * @param CatalogComplectation $catalogComplectation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogComplectationsRequest $request, CatalogComplectation $catalogComplectation)
    {
        $equipments = $request->equipment;
        $pack_names = $request->pack_name;
        $pack_prices = $request->pack_price;
        $parameter_packs = $request->parameter_pack;

        $request->request->remove('equipment');
        $request->request->remove('pack_name');
        $request->request->remove('pack_price');
        $request->request->remove('parameter_pack');

        $carComplectation = CatalogComplectation::create($request->except('_token'));

        if ($carComplectation->save()) {
            foreach ($equipments as $equipment) {
                $parameterComplectation = new CatalogParameterComplectation;
                $parameterComplectation->id_complectation = $carComplectation->id;
                $parameterComplectation->id_parameter = $equipment;
                $parameterComplectation->save();
            }
        }

        for($i = 0; $i < count($pack_names); $i++) {
            $name = $pack_names[$i];
            $price = $pack_prices[$i];
            $parameters = $parameter_packs[$i];

            $parameterPack = new CatalogParameterPack;
            $parameterPack->id_complectation = $carComplectation->id;
            $parameterPack->name = trim($name);
            $parameterPack->price = trim($price);

            if ($parameterPack->save()) {
                foreach ($parameters as $parameter) {
                    $packParameter = new CatalogParameterPackParameter;
                    $packParameter->id_parameter = $parameter;
                    $packParameter->id_pack = $parameterPack->id;
                    $packParameter->save();
                }
            }
        }

        $catalogComplectation->name = trim($request->input('name'));
        $catalogComplectation->id_model = $request->input('id_model');
        $catalogComplectation->updated_at = \Carbon::now();
        $id_complectation = $request->input('id_complectation');

        if ($catalogComplectation->save()) {

            CatalogParameterComplectation::query()->where('id_complectation', $id_complectation)->delete();
            CatalogParameterPack::query()->join('catalog_parameter_pack_parameter', 'catalog_parameter_pack_parameter.id_pack', '=', 'catalog_parameter_pack.id')->where('catalog_parameter_pack.id_complectation', $id_complectation)->delete();

            foreach ($equipments as $equipment) {
                $parameterComplectation = new CatalogParameterComplectation;
                $parameterComplectation->id_complectation =  $id_complectation;
                $parameterComplectation->id_parameter = $equipment;
                $parameterComplectation->save();
            }

            for($i = 0; $i < count($pack_names); $i++) {
                $name = $pack_names[$i];
                $price = $pack_prices[$i];
                $parameters = $parameter_packs[$i];

                $parameterPack = new CatalogParameterPack;
                $parameterPack->id_complectation = $id_complectation;
                $parameterPack->name = trim($name);
                $parameterPack->price = trim($price);

                if ($parameterPack->save()) {
                    foreach ($parameters as $parameter) {
                        $packParameter = new CatalogParameterPackParameter;
                        $packParameter->id_parameter = $parameter;
                        $packParameter->id_pack = $parameterPack->id;
                        $packParameter->save();
                    }
                }
            }
        }

        return redirect('admin/catalog/models/model/' . $catalogComplectation->id_model . '/complectations')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogComplectationsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogComplectationsRequest $request)
    {
        $equipments = $request->equipment;
        $pack_names = $request->pack_name;
        $pack_prices = $request->pack_price;
        $parameter_packs = $request->parameter_pack;

        $request->request->remove('equipment');
        $request->request->remove('pack_name');
        $request->request->remove('pack_price');
        $request->request->remove('parameter_pack');

        $carComplectation = CatalogComplectation::create($request->except('_token'));

        if ($carComplectation->save()) {
            foreach ($equipments as $equipment) {
                $parameterComplectation = new CatalogParameterComplectation;
                $parameterComplectation->id_complectation = $carComplectation->id;
                $parameterComplectation->id_parameter = $equipment;
                $parameterComplectation->save();
            }
        }

        for($i = 0; $i < count($pack_names); $i++) {
            $name = $pack_names[$i];
            $price = $pack_prices[$i];
            $parameters = $parameter_packs[$i];

            $parameterPack = new CatalogParameterPack;
            $parameterPack->id_complectation = $carComplectation->id;
            $parameterPack->name = trim($name);
            $parameterPack->price = trim($price);

            if ($parameterPack->save()) {

                foreach ($parameters as $parameter) {
                    $packParameter = new CatalogParameterPackParameter;
                    $packParameter->id_parameter = $parameter;
                    $packParameter->id_pack = $parameterPack->id;
                    $packParameter->save();
                }
            }
        }

        return redirect('admin/catalog/models/model/' . $request->id_model . '/complectations')->with('success', 'Комплектация добавлена');
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
