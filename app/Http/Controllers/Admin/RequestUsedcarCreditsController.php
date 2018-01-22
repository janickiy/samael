<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestUsedcarCreditsRequest;
use App\Http\Controllers\Controller;
use App\RequestUsedcarCredit;

class RequestUsedcarCreditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.requestcredits.usedcar.index');
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
     * @param RequestUsedcarCredit $requestcredit
     * @return $this
     */
    public function edit(RequestUsedcarCredit $requestcredit)
    {
        return view('admin.requestcredits.usedcar.create_edit')->with(compact('requestcredit'));
    }

    /**
     * @param RequestUsedcarCreditsRequest $request
     * @param RequestUsedcarCredit $requestCredit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestUsedcarCreditsRequest $request, RequestUsedcarCredit $requestCredit)
    {
        $requestCredit->name = trim($request->input('name'));
        $requestCredit->age = $request->input('age');
        $requestCredit->phone = trim($request->input('phone'));
        $requestCredit->email = trim($request->input('email'));
        $requestCredit->registration = trim($request->input('registration'));
        $requestCredit->fee = $request->input('fee');
        $requestCredit->status = $request->input('status');
        $requestCredit->updated_at = \Carbon::now();
        $requestCredit->save();

        return redirect('admin/requestusedcarcredits')->with('success', 'Заявка на авто № ' . $requestCredit->id . ' успешно обнавлена');
    }

    /**
     * @param Request $request
     * @param RequestUsedcarCredit $requestCredit
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, RequestUsedcarCredit $requestCredit)
    {
        if ($request->ajax()) {
            $requestCredit->delete();
            return response()->json(['success' => 'Заявка на авторедит удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}