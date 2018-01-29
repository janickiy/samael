<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CatalogMarksRequest;
use App\Http\Controllers\Controller;
use App\CatalogMark;
use Intervention\Image\Facades\Image as ImageInt;

class CatalogmarksController extends Controller
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
    public function create()
    {
        return view('admin.catalogmarks.create_edit');
    }

    /**
     * @param CatalogMark $catalogMark
     * @return $this
     */
    public function edit(CatalogMark $catalogmark)
    {
        return view('admin.catalogmarks.create_edit')->with(compact('catalogmark'));
    }

    /**
     * @param CatalogMarksRequest $request
     * @param CatalogMark $catalogMark
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CatalogMarksRequest $request, CatalogMark $catalogMark)
    {
        $catalogMark->name = trim($request->input('name'));
        $catalogMark->name_rus = trim($request->input('name_rus'));
        $catalogMark->published = $request->input('published');
        $catalogMark->slug = $request->input('slug');
        $catalogMark->annotation = trim($request->input('annotation'));
        $catalogMark->content = trim($request->input('content'));
        $catalogMark->autocredit = $request->input('autocredit');
        $catalogMark->winterwheels = $request->input('winterwheels');
        $catalogMark->waypaid = $request->input('waypaid');
        $catalogMark->cascogift = $request->input('cascogift');

        if ($request->hasFile('logo')) {
            $logo_path = public_path() . PATH_MARK;
            $logo = $request->file('logo');

            $filename = str_random(20) . '.' . $logo->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($logo);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_path . $filename);

            $catalogMark->logo = PATH_MARK . $filename;
        }

        $catalogMark->meta_keywords = $request->input('meta_keywords');
        $catalogMark->meta_description = $request->input('meta_description');
        $catalogMark->updated_at = \Carbon::now();
        $catalogMark->save();

        return redirect('admin/catalogmarks')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CatalogMarksRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CatalogMarksRequest $request)
    {
        $catalogmark = new CatalogMark($request->except('_token', 'mark_id', 'published'));
        $catalogmark->published = 0;

        if ($request->input('published')) {
            $catalogmark->published = 1;
        }

        $catalogmark->autocredit = 0;

        if ($request->input('autocredit')) {
            $catalogmark->autocredit = 1;
        }

        $catalogmark->winterwheels = 0;

        if ($request->input('winterwheels')) {
            $catalogmark->winterwheels = 1;
        }

        $catalogmark->waypaid = 0;

        if ($request->input('waypaid')) {
            $catalogmark->waypaid = 1;
        }

        $catalogmark->cascogift = 0;

        if ($request->input('cascogift')) {
            $catalogmark->cascogift = 1;
        }

        if ($request->hasFile('logo')) {
            $logo_path = public_path() . PATH_MARK;
            $logo = $request->file('logo');

            $filename = str_random(20) . '.' . $logo->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($logo);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_path . $filename);

            $catalogmark->logo = PATH_MARK . $filename;
        }

        $catalogmark->save();

        return redirect('admin/catalogmarks')->with('success', 'Марка ' . $catalogmark->name . ' успешно добавлена');
    }

    /**
     * @param Request $request
     * @param CatalogMark $catalogMark
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CatalogMark $catalogMark)
    {
        if ($request->ajax()) {

            if ($catalogMark->logo) {
                if (file_exists(public_path() . $catalogMark->logo)) @unlink(public_path() . $catalogMark->logo);
            }

            $catalogMark->delete();
            return response()->json(['success' => 'Марка удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}