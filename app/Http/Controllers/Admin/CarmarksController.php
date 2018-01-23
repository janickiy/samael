<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CarMarksRequest;
use App\Http\Requests\CarMarksImportRequest;
use App\Http\Controllers\Controller;
use App\CarMark;
use App\CarModel;
use App\CarModification;
use Intervention\Image\Facades\Image as ImageInt;

class CarmarksController extends Controller
{
    const IDCARTYPE = 1;

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
    public function create()
    {
        return view('admin.carmarks.create_edit');
    }

    /**
     * @param CarMark $carMark
     * @return $this
     */
    public function edit(CarMark $carmark)
    {
        return view('admin.carmarks.create_edit')->with(compact('carmark'));
    }

    /**
     * @param CarMarksRequest $request
     * @param CarMark $carMark
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CarMarksRequest $request, CarMark $carMark)
    {
        $carMark->name = $request->input('name');
        $carMark->id_car_type = self::IDCARTYPE;
        $carMark->name_rus = $request->input('name_rus');
        $carMark->published = $request->input('published');
        $carMark->slug = $request->input('slug');

        if ($request->hasFile('logo')) {
            $logo_path = public_path() . PATH_MARK;
            $logo = $request->file('logo');

            $filename = str_random(20) . '.' . $logo->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($logo);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_path . $filename);

            $carMark->logo = PATH_MARK . $filename;
        }

        $carMark->meta_keywords = $request->input('meta_keywords');
        $carMark->meta_description = $request->input('meta_description');
        $carMark->updated_at = \Carbon::now();
        $carMark->save();

        return redirect('admin/carmarks')->with('success', 'Данные обнавлены');
    }

    /**
     * @param CarMarksRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CarMarksRequest $request)
    {
        $carmark = new CarMark($request->except('_token', 'mark_id', 'published'));
        $carmark->published = 0;

        if($request->input('published')) {
            $carmark->published = 1;
        }

        if ($request->hasFile('logo')) {
            $logo_path = public_path() . PATH_MARK;
            $logo = $request->file('logo');

            $filename = str_random(20) . '.' . $logo->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($logo);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($logo_path . $filename);

            $carmark->logo = PATH_MARK . $filename;
        }

        $carmark->save();

        return redirect('admin/carmarks')->with('success', 'Марка ' . $carmark->name . ' успешно добавлена');
    }

    /**
     * @param Request $request
     * @param CarMark $carMark
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, CarMark $carMark)
    {
        if ($request->ajax()) {

            if ($carMark->logo) {
                if (file_exists(public_path() . $carMark->logo)) @unlink(public_path() . $carMark->logo);
            }

            $carMark->delete();
            return response()->json(['success' => 'Марка удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import()
    {
        return view('admin.carmarks.import');
    }

    /**
     * @param CarMarksImportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function importCarmarks(CarMarksImportRequest $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $xml = simplexml_load_file($file);

            if ($xml) {
                CarMark::query()->truncate();
                CarModel::query()->truncate();
                CarModification::query()->truncate();
            }

            foreach($xml->mark as $row_mark) {
                if ($row_mark->code) {
                    $carMarks = new CarMark;
                    $carMarks->name = formatMarkNames($row_mark->code);
                    $carMarks->name_rus = formatMarkNames(Lat2ru($row_mark->code));
                    $carMarks->id_car_type = self::IDCARTYPE;
                    $carMarks->slug = trim(strtolower($row_mark->code));
                    $carMarks->meta_title = formatMarkNames($row_mark->code);
                    $carMarks->published = 1;

                    if ($carMarks->save()) {
                        $id_car_mark = $carMarks->id;

                        foreach($row_mark->folder as $row_folder){
                            $carModel = new CarModel;
                            $carModel->id_car_mark = $id_car_mark;
                            $carModel->id_car_type = self::IDCARTYPE;
                            $carModel->name = $row_folder[0]['name'];
                            $carModel->name_rus = Lat2ru($row_folder[0]['name']);
                            $carModel->slug = slug($row_folder[0]['name']);
                            $carModel->meta_title = $row_folder[0]['name'];
                            $carModel->published  = 1;

                            if ($carModel->save()) {
                                $id_car_model = $carModel->id;
                                foreach ($row_folder->modification as $modification) {
                                    if ($modification->modification_id && $modification->body_type) {
                                        $carModification = new CarModification;
                                        $carModification->id_car_model = $id_car_model;
                                        $carModification->name = $modification->modification_id;
                                        $carModification->body_type = $modification->body_type;
                                        $carModification->id_car_type = self::IDCARTYPE;
                                        $years = $modification->years;

                                        preg_match('/(\d+)\s+-\s((по н\.в\.)|(\d+))$/', $years, $matches);

                                        $carModification->year_begin = isset($matches[1]) && is_numeric($matches[1]) ? $matches[1] : date("Y");
                                        $carModification->year_end = isset($matches[2]) && is_numeric($matches[2])? $matches[2] : date("Y");
                                        $carModification->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return redirect('admin/carmarks/import')->with('success', 'Импорт завершен');
    }
}