<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CarModelsRequest;
use App\Http\Controllers\Controller;
use App\CarModel;
use App\CarMark;
use Intervention\Image\Facades\Image as ImageInt;

class CarmodelsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.carmarks.index');
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
        return view('admin.carmodels.create_edit')->with('id_car_mark', $id);
    }

    /**
     * @param CarModel $carmodel
     * @return $this
     */
    public function edit(CarModel $carmodel)
    {
        return view('admin.carmodels.create_edit')->with(compact('carmodel'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function carmark($id)
    {
        $carmark = CarMark::where('id', $id)->first();
        return view('admin.carmodels.carmark', compact('carmodels'))->with(compact('carmark'));
    }

    /**
     * @param CarModelsRequest $request
     * @param CarModel $carModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CarModelsRequest $request, CarModel $carModel)
    {
        $carModel->name = $request->input('name');
        $carModel->id_car_type = 1;
        $carModel->name_rus = trim($request->input('name_rus'));

        if ($request->hasFile('image')) {
            $image_path = public_path() . PATH_MODEL;
            $image = $request->file('image');

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $carModel->image = PATH_MODEL . $filename;
        }

        $carModel->published = $request->input('published');
        $carModel->updated_at = \Carbon::now();
        $carModel->save();

        return redirect('admin/carmodels/' . $carModel->id . '/edit')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CarModelsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CarModelsRequest $request)
    {
        $carmodel = CarModel::create($request->except('_token'));
        $carmodel->save();

        return redirect('admin/carmodels/carmark/' . $request->id_car_mark)->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CarModel $carModel
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CarModel $carModel)
    {
        if ($request->ajax()) {
            if ($carModel->image) {
                if (file_exists(public_path() . $carModel->image)) @unlink(public_path() . $carModel->image);
            }

            $carModel->delete();
            return response()->json(['success' => 'Модель удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
