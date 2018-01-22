<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CarModificationsRequest;
use App\Http\Controllers\Controller;
use App\CarModification;

class CarmodificationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        return view('admin.carmodifications.index')->with('id', $id);
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
        return view('admin.carmodifications.create_edit')->with('id_car_model', $id);;
    }
    /**
     * @param CarModification $carmodification
     * @return $this
     */
    public function edit(CarModification $carmodification)
    {
        return view('admin.carmodifications.create_edit')->with(compact('carmodification'));
    }

    /**
     * @param CarModificationsRequest $request
     * @param CarModification $carModification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CarModificationsRequest $request, CarModification $carModification)
    {
       // $modification = CarModification::where('id', $carModification->id)->first();

        $carModification->name = $request->input('name');
        $carModification->id_car_type = 1;
        $carModification->body_type = $request->input('body_type');
        $carModification->year_begin = $request->input('year_begin');
        $carModification->year_end = $request->input('year_end');
        $carModification->save();

        return redirect('admin/carmodifications/model/' . $carModification->id_car_model)->with('success', 'Данные обнавлены');
    }

    /**
     * @param CarModificationsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CarModificationsRequest $request)
    {
        $carModification = CarModification::create($request->except('_token'));
        $carModification->save();

        return redirect('admin/carmodifications/model/' . $request->id_car_model)->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CarModification $carmodification
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CarModification $carmodification)
    {
        if ($request->ajax()) {
            $carmodification->delete();
            return response()->json(['success' => 'Модификация удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
