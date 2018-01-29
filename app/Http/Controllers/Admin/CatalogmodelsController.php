<?php

namespace App\Http\Controllers\Admin;

use App\CatalogModifications;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CatalogModelsRequest;
use App\Http\Controllers\Controller;
use App\CatalogModel;
use App\CatalogMark;
use Intervention\Image\Facades\Image as ImageInt;

class CatalogmodelsController extends Controller
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
        $id_car_mark = $catalogmodel->id_car_mark;
        return view('admin.catalogmodels.create_edit')->with(compact('catalogmodel', 'id_car_mark'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function catalogmark($id)
    {
        $catalogmark = CatalogMark::where('id', $id)->first();
        return view('admin.catalogmodels.catalogmark', compact('catalogmodels'))->with(compact('catalogmark'));
    }

    /**
     * @param CatalogModelsRequest $request
     * @param CatalogModel $catalogModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogModelsRequest $request, CatalogModel $catalogModel)
    {
        $catalogModel->name = $request->input('name');
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

        $catalogModel->annotation = trim($request->input('annotation'));
        $catalogModel->content = trim($request->input('content'));
        $catalogModel->parametersContent = trim($request->input('parametersContent'));
        $catalogModel->galleryContent = trim($request->input('galleryContent'));
        $catalogModel->meta_title = trim($request->input('meta_title'));
        $catalogModel->meta_keywords = trim($request->input('meta_keywords'));
        $catalogModel->meta_description = trim($request->input('meta_description'));
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

        $catalogmodel->published = 0;

        if ($request->input('published')) {
            $catalogmodel->published = 1;
        }

        if ($request->hasFile('image')) {
            $image_path = public_path() . PATH_MODEL;
            $image = $request->file('image');

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $catalogmodel->image = PATH_MODEL . $filename;
        }


        $catalogmodel->save();

        return redirect('admin/catalogmodels/catalogmark/' . $request->id_car_mark)->with('success', ' добавлена');
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

    public function bodies($id)
    {

    }

    public function modifications($id)
    {
        $modifications = CatalogModifications::where('model', $id)
                        ->get();

        return view('admin.catalogmodifications.index', compact('modifications'))->with('id', $id);;
    }

    public function complectations($id)
    {


    }

    public function packs($id)
    {

    }
}