<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RequestTradeInsRequest;
use App\Http\Controllers\Controller;
use App\RequestTradeIn;

class RequestTradeInsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.requesttradeins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @param RequestTradeIn $requesttradein
     * @return $this
     */
    public function edit(RequestTradeIn $requesttradein)
    {
        return view('admin.requesttradeins.create_edit')->with(compact('requesttradein'));
    }

    /**
     * @param RequestTradeInsRequest $request
     * @param RequestTradeIn $requestTradeIn
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestTradeInsRequest $request, RequestTradeIn $requestTradeIn)
    {
        $requestTradeIn->name = trim($request->input('name'));
        $requestTradeIn->mark = trim($request->input('mark'));
        $requestTradeIn->model = trim($request->input('model'));
        $requestTradeIn->year = trim($request->input('year'));
        $requestTradeIn->mileage = trim($request->input('mileage'));
        $requestTradeIn->trade_in_mark = $request->input('trade_in_mark');
        $requestTradeIn->trade_in_model = $request->input('trade_in_model');
        $requestTradeIn->trade_in_complectation = $request->input('trade_in_complectation');
        $requestTradeIn->updated_at = \Carbon::now();
        $requestTradeIn->save();

        return redirect('admin/requesttradeins')->with('success', 'Заявка на Trade-in № ' . $requestTradeIn->id . ' успешно обнавлена');
    }

    /**
     * @param Request $request
     * @param RequestTradeIn $requestTradeIn
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, RequestTradeIn $requestTradeIn)
    {
        if ($request->ajax()) {
            $requestTradeIn->delete();
            return response()->json(['success' => 'Заявка на Trade-in удалена']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}
