<?php

namespace App\Http\Controllers\Admin;

use App\CatalogColor;
use App\CatalogComplectation;
use App\CatalogPack;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogModelsRequest;
use App\Http\Controllers\Controller;
use App\CatalogModel;
use App\CatalogMark;
use App\CatalogModification;
use Intervention\Image\Facades\Image as ImageInt;

class CatalogmodelsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.catalog.marks.index');
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
        return view('admin.catalog.models.create_edit')->with('id_car_mark', $id);
    }

    /**
     * @param CatalogModel $catalogmodel
     * @return $this
     */
    public function edit(CatalogModel $catalogmodel)
    {
        $id_car_mark = $catalogmodel->id_car_mark;
        return view('admin.catalog.models.create_edit')->with(compact('catalogmodel', 'id_car_mark'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function catalogmark($id)
    {
        $catalogmark = CatalogMark::where('id', $id)->first();
        return view('admin.catalog.models.catalogmark')->with(compact('catalogmark'));
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

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ?: 'png';
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
        $catalogModel->bannerText = trim($request->input('bannerText'));
        $catalogModel->meta_title = trim($request->input('meta_title'));
        $catalogModel->meta_keywords = trim($request->input('meta_keywords'));
        $catalogModel->meta_description = trim($request->input('meta_description'));
        $catalogModel->body_type = $request->input('body_type');
        $catalogModel->published = $request->input('published');
        $catalogModel->special = $request->input('special');
        $catalogModel->updated_at = \Carbon::now();
        $catalogModel->save();

        return redirect('admin/catalog/models/' . $catalogModel->id . '/edit')->with('success', 'Данные обнавлены');
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

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $catalogmodel->image = PATH_MODEL . $filename;
        }

        $catalogmodel->save();

        return redirect('admin/catalog/models/mark/' . $request->id_car_mark)->with('success', ' добавлена');
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

            $catalogColors = CatalogColor::select(['image'])->where('id_model', $catalogModel->id)->get()->toArray();

            foreach ($catalogColors as $catalogColor) {
                if (file_exists(public_path() . $catalogColor['image'])) @unlink(public_path() . $catalogColor['image']);
            }

            CatalogColor::where('id_model', $catalogModel->id)->delete();
            CatalogComplectation::where('id_model', $catalogModel->id)
                ->leftJoin('catalog_parameter_complectation', 'catalog_parameter_complectation.id_complectation', '=', 'catalog_complectations.id')
                ->leftJoin('catalog_parameter_pack', 'catalog_parameter_pack.id_complectation', '=', 'catalog_complectations.id')
                ->delete();

            CatalogModification::where('id_model', $catalogModel->id)->delete();
            CatalogPack::where('id_model', $catalogModel->id)
                ->leftJoin('catalog_parameter_pack_parameter', 'catalog_parameter_pack_parameter.id_pack', '=', 'catalog_packs.id')
                ->delete();

            $catalogModel->delete();
            return response()->json(['success' => 'Модель удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function modifications($id)
    {
        $mark = CatalogModel::select(['catalog_marks.id', 'catalog_marks.name as mark', 'catalog_models.name as model'])->join('catalog_marks', 'catalog_models.id_car_mark', '=', 'catalog_marks.id')->where('catalog_models.id',$id)->first()->toArray();
        $modifications = CatalogModification::where('id_model', $id)
            ->get();

        return view('admin.catalog.modifications.index', compact('modifications', 'mark'))->with('id', $id);
    }

    /**
     * @param $id
     * @return $this
     */
    public function complectations($id)
    {
        $mark = CatalogModel::select(['catalog_marks.id', 'catalog_marks.name as mark', 'catalog_models.name as model'])->join('catalog_marks', 'catalog_models.id_car_mark', '=', 'catalog_marks.id')->where('catalog_models.id',$id)->first()->toArray();
        return view('admin.catalog.complectations.index', compact('modifications','mark'))->with('id', $id);
    }

    /**
     * @param $id
     * @return $this
     */
    public function packs($id)
    {
        $mark = CatalogModel::select(['catalog_marks.id', 'catalog_marks.name as mark', 'catalog_models.name as model'])->join('catalog_marks', 'catalog_models.id_car_mark', '=', 'catalog_marks.id')->where('catalog_models.id',$id)->first()->toArray();
        $modifications = CatalogModification::select(['name', 'id'])->where('id_model', $id)->get();
        $complectations = CatalogComplectation::where('id_model', $id)->get();

        return view('admin.catalog.packs.index', compact('modifications', 'complectations', 'mark'))->with('id', $id);
    }

    /**
     * @param $id
     * @return $this
     */
    public function colors($id)
    {
        $mark = CatalogModel::select(['catalog_marks.id', 'catalog_marks.name as mark', 'catalog_models.name as model'])->join('catalog_marks', 'catalog_models.id_car_mark', '=', 'catalog_marks.id')->where('catalog_models.id',$id)->first()->toArray();
        return view('admin.catalog.colors.index', compact('mark'))->with('id', $id);
    }
}
