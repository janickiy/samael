<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogModificationsRequest;
use App\Http\Controllers\Controller;
use App\CatalogModification;

class CatalogmodificationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        return view('admin.catalog.modifications.index')->with('id', $id);
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
        return view('admin.catalog.modifications.create_edit')->with('id_model', $id);
    }

    /**
     * @param CatalogModification $catalogmodification
     * @return $this
     */
    public function edit(CatalogModification $catalogmodification)
    {
        $id_model = $catalogmodification->id_model;
        return view('admin.catalog.modifications.create_edit')->with(compact('catalogmodification', 'id_model'));
    }

    /**
     * @param CatalogModificationsRequest $request
     * @param CatalogModification $catalogModification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogModificationsRequest $request, CatalogModification $catalogModification)
    {
        // $modification = CarModification::where('id', $carModification->id)->first();

        $catalogModification->name = $request->input('name');
        $catalogModification->id_model = $request->input('id_model');
        $catalogModification->name = trim($request->input('name'));
        $catalogModification->body_type = trim($request->input('body_type'));
        $catalogModification->length = trim($request->input('length'));
        $catalogModification->width = trim($request->input('width'));
        $catalogModification->height = trim($request->input('height'));
        $catalogModification->wheel_base = trim($request->input('wheel_base'));
        $catalogModification->front_rut = trim($request->input('front_rut'));
        $catalogModification->back_rut = trim($request->input('back_rut'));
        $catalogModification->front_overhang = trim($request->input('front_overhang'));
        $catalogModification->back_overhang = trim($request->input(''));
        $catalogModification->trunk_volume_min = trim($request->input('trunk_volume_min'));
        $catalogModification->trunk_volume_max = trim($request->input('trunk_volume_max'));
        $catalogModification->tank_volume = trim($request->input('tank_volume'));
        $catalogModification->front_brakes = trim($request->input('front_brakes'));
        $catalogModification->back_brakes = trim($request->input('back_brakes'));
        $catalogModification->front_suspension = trim($request->input('front_suspension'));
        $catalogModification->back_suspension = trim($request->input('back_suspension'));
        $catalogModification->engine_displacement = trim($request->input('engine_displacement'));
        $catalogModification->engine_displacement_working_value = trim($request->input('engine_displacement_working_value'));
        $catalogModification->engine_type = trim($request->input('engine_type'));
        $catalogModification->gearbox = trim($request->input('gearbox'));
        $catalogModification->gears = trim($request->input('gears'));
        $catalogModification->drive = trim($request->input('drive'));
        $catalogModification->power = trim($request->input('power'));
        $catalogModification->consume_city = trim($request->input('consume_city'));
        $catalogModification->consume_track = trim($request->input('consume_track'));
        $catalogModification->consume_mixed = trim($request->input('consume_mixed'));
        $catalogModification->acceleration_100km = trim($request->input('acceleration_100km'));
        $catalogModification->max_speed = trim($request->input('max_speed'));
        $catalogModification->clearance = trim($request->input('clearance'));
        $catalogModification->min_mass = trim($request->input('min_mass'));
        $catalogModification->max_mass = trim($request->input('max_mass'));
        $catalogModification->trailer_mass = trim($request->input('trailer_mass'));
        $catalogModification->save();

        return redirect('admin/catalog/models/model/' . $catalogModification->id_model . '/modifications')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogModificationsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogModificationsRequest $request)
    {
        $carModification = CatalogModification::create($request->except('_token'));
        $carModification->save();

        return redirect('admin/catalog/models/model/' . $carModification->id_model . '/modifications')->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogModification $catalogModification
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogModification $catalogModification)
    {
        if ($request->ajax()) {
            $catalogModification->delete();
            return response()->json(['success' => 'Модификация удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
