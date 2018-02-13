<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestCreditsRequest;
use App\Http\Controllers\Controller;
use App\RequestCredit;

class RequestCreditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.requestcredits.car.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @param RequestCredit $requestcredit
     * @return $this
     */
    public function edit(RequestCredit $requestcredit)
    {
        return view('admin.requestcredits.car.create_edit')->with(compact('requestcredit'));
    }

    /**
     * @param RequestCreditsRequest $request
     * @param RequestCredit $requestCredit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestCreditsRequest $request, RequestCredit $requestCredit)
    {
        $requestCredit->name = trim($request->input('name'));
        $requestCredit->age = $request->input('age');
        $requestCredit->phone = trim($request->input('phone'));
        $requestCredit->registration = trim($request->input('registration'));
        $requestCredit->fee = $request->input('fee');
        $requestCredit->updated_at = \Carbon::now();

        $requestCredit->status = 0;

        if($request->input('status')) {
            $requestCredit->status = 1;
        }

        $requestCredit->save();

        return redirect('admin/requestcredits')->with('success', 'Заявка на авто № ' . $requestCredit->id . ' успешно обнавлена');
    }

    /**
     * @param Request $request
     * @param RequestCredit $requestCredit
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, RequestCredit $requestCredit)
    {
        if ($request->ajax()) {
            $requestCredit->delete();
            return response()->json(['success' => 'Заявка на авторедит удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}