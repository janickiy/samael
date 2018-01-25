<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CarMarksRequest;
use App\Http\Requests\CarMarksImportRequest;
use App\Http\Controllers\Controller;
use App\CarMark;
use App\CarModel;

class CarmarksController extends Controller
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
            }

            foreach($xml->mark as $row_mark) {
                if ($row_mark->code) {
                    $carMarks = new CarMark;
                    $carMarks->name = formatMarkNames($row_mark->code);

                    if ($carMarks->save()) {
                        $id_car_mark = $carMarks->id;

                        foreach($row_mark->folder as $row_folder){
                            $carModel = new CarModel;
                            $carModel->id_car_mark = $id_car_mark;
                            $carModel->name = $row_folder[0]['name'];

                            $carModel->save();
                        }
                    }
                }
            }
        }

        return redirect('admin/carmarks/import')->with('success', 'Импорт завершен');
    }
}