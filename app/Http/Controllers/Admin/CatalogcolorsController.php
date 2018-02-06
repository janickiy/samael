<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogColorsRequest;
use App\Http\Controllers\Controller;
use App\CatalogColor;
use Intervention\Image\Facades\Image as ImageInt;

class CatalogcolorsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        return view('admin.catalog.colors.index')->with('id_model', $id);
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
        return view('admin.catalog.colors.create_edit')->with('id_model', $id);
    }

    /**
     * @param CatalogColor $catalogcolor
     * @return $this
     */
    public function edit(CatalogColor $catalogcolor)
    {
        $id_model = $catalogcolor->id_model;
        return view('admin.catalog.colors.create_edit')->with(compact('catalogcolor', 'id_model'));
    }

    /**
     * @param CatalogColorsRequest $request
     * @param CatalogColor $catalogColor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogColorsRequest $request, CatalogColor $catalogColor)
    {
        $catalogColor->id_model = $request->input('id_model');
        $catalogColor->name = trim($request->input('name'));
        $catalogColor->hex = trim($request->input('hex'));
        $catalogColor->published = $request->input('published');

        if ($request->hasFile('image')) {
            $image_path = public_path() . PATH_COLOR;
            $image = $request->file('image');

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $catalogColor->image = PATH_COLOR . $filename;
        }

        $catalogColor->updated_at = \Carbon::now();
        $catalogColor->save();

        return redirect('admin/catalog/models/model/' . $catalogColor->id_model . '/colors')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogColorsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogColorsRequest $request)
    {
        $catalogColor = CatalogColor::create($request->except('_token'));
        $catalogColor->published = 0;

        if ($request->input('published')) {
            $catalogColor->published = 1;
        }

        if ($request->hasFile('image')) {
            $image_path = public_path() . PATH_COLOR;
            $image = $request->file('image');

            $filename = str_random(20) . '.' . $image->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($image);

            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($image_path . $filename);

            $catalogColor->image = PATH_COLOR . $filename;
        }

        $catalogColor->save();

        return redirect('admin/catalog/models/model/' . $request->id_model . '/colors')->with('success', 'Цвет добавлен');
    }

    /**
     * @param Request $request
     * @param CatalogColor $catalogColor
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogColor $catalogColor)
    {
        if ($request->ajax()) {
            $catalogColor->delete();
            return response()->json(['success' => 'Цвет удален']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
