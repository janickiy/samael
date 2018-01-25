<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CatalogModelsRequest;
use App\Http\Controllers\Controller;
use App\CatalogModel;
use App\CatalogMark;
use Intervention\Image\Facades\Image as ImageInt;

class CarmodelsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.catalogmarks.index');
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
        return view('admin.catalogmodels.create_edit')->with('id_car_mark', $id);
    }

    /**
     * @param CatalogModel $catalogmodel
     * @return $this
     */
    public function edit(CatalogModel $catalogmodel)
    {
        return view('admin.catalogmodels.create_edit')->with(compact('carmodel'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function carmark($id)
    {
        $carmark = CatalogMark::where('id', $id)->first();
        return view('admin.catalogmodels.carmark', compact('catalogmodels'))->with(compact('catalogmark'));
    }

    /**
     * @param CatalogModelsRequest $request
     * @param CatalogModel $carModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogModelsRequest $request, CatalogModel $catalogModel)
    {
        $catalogModel->name = $request->input('name');
        $catalogModel->id_car_type = 1;
        $catalogModel->name_rus = trim($request->input('name_rus'));

        if ($request->hasFile('image')) {
            $image_path = public_path() . PATH_MODEL;
            $image = $request->file('image');

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $catalogModel->image = PATH_MODEL . $filename;
        }

        $catalogModel->published = $request->input('published');
        $catalogModel->updated_at = \Carbon::now();
        $catalogModel->save();

        return redirect('admin/catalogmodels/' . $catalogModel->id . '/edit')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogModelsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogModelsRequest $request)
    {
        $catalogmodel = CatalogModel::create($request->except('_token'));
        $catalogmodel->save();

        return redirect('admin/catalogmodels/carmark/' . $request->id_car_mark)->with('success', ' добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogModel $catalogModel
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogModel $catalogModel)
    {
        if ($request->ajax()) {
            if ($catalogModel->image) {
                if (file_exists(public_path() . $catalogModel->image)) @unlink(public_path() . $catalogModel->image);
            }

            $catalogModel->delete();
            return response()->json(['success' => 'Модель удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
