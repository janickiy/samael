<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CallbacksRequest;
use App\Http\Controllers\Controller;
use App\Callback;

class CallbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.callback.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.callback.create_edit');
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
     * @param callable $callback
     * @return $this
     */
    public function edit(Callback $callback)
    {
        return view('admin.callback.create_edit')->with(compact('callback'));
    }

    /**
     * @param CallbacksRequest $request
     * @param callable $callback
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CallbacksRequest $request, Callback $callback)
    {
        $callback->name = $request->input('name');
        $callback->phone = $request->input('phone');
        $callback->from_time = $request->input('from_time');
        $callback->to_time = $request->input('to_time');
        $callback->save();

        return redirect('admin/callbacks')->with('success', 'Действия выполнены');
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, Callback $callback)
    {
        if ($request->ajax()) {
            $callback->delete();
            return response()->json(['success' => 'Заявка на обратный звонок удалена']);
        } else {
            return 'Вы не можете продолжить операцию удаления';
        }
    }
}
