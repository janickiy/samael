<?php

namespace App\Http\Controllers\Admin;

use App\CatalogParameterComplectation;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Callback;
use App\CatalogModel;
use App\CatalogPack;
use App\Page;
use App\User;
use App\UserReview;
use App\RequestCredit;
use App\RequestTradeIn;
use App\CarMark;
use App\CarModel;
use App\CatalogParameterValue;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->count();
        $pages = Page::page()->count();
        $requestcredits = RequestCredit::all()->count();
        $requesttradeins = RequestTradeIn::all()->count();
        $reviews = UserReview::all()->count();
        $carmarks = CarMark::all()->count();
        $callbacks = Callback::all()->count();
        $cars = CatalogModel::all()->count();

        return view('admin.dashboard')->with(compact('users', 'pages', 'reviews', 'requestcredits', 'requesttradeins', 'carmarks', 'callbacks', 'cars'));
    }

    /**
     * @param Request $request
     * @param UserReview $userReview
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(Request $request, UserReview $userReview)
    {
        if (isset($request->action)) {
            switch ($request->action) {
                case 'approve':
                    $userReview->id = $request->id;
                    $userReview->exists = true;
                    $userReview->published = 1;
                    $userReview->published_at = \Carbon::now();
                    $userReview->updated_at = \Carbon::now();

                    if ($userReview->save()) {
                        return response()->json(['success' => 'Отзыв одобрен']);
                    } else {
                        return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                    }

                    break;

                case 'search_mark':

                    $search_mark = trim(strip_tags(stripcslashes(htmlspecialchars($request->mark))));
                    $marks = CarMark::where('name', 'LIKE', '%' . $search_mark . '%')->get();

                    $rows = [];

                    foreach ($marks as $mark) {
                        $rows[] = [
                            "id" => $mark->id,
                            "name" => $mark->name,
                            "name_rus" => $mark->name_rus,
                            "slug" => $mark->slug,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;

                case 'search_model':

                    $search_model = trim(strip_tags(stripcslashes(htmlspecialchars($request->model))));

                    $models = CarModel::where('id_car_mark', $request->id_car_mark)
                        ->where('name', 'LIKE', '%' . $search_model . '%')
                        ->get();

                    $rows = [];

                    foreach ($models as $model) {
                        $rows[] = [
                            "id" => $model->id,
                            "name" => $model->name,
                            "name_rus" => $model->name_rus,
                            "slug" => $model->slug,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;

                case 'get_modifications':

                    $modifications = CarModification::where('id_car_model', $request->id_car_model)
                        ->get();
                    $rows = [];

                    foreach ($modifications as $modification) {
                        $rows[] = [
                            "id" => $modification->id,
                            "name" => $modification->name,
                            "body_type" => $modification->body_type,
                            "year_begin" => $modification->year_begin,
                            "year_end" => $modification->year_end,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;

                case 'get_models':

                    $models = CarModel::where('id_car_mark', $request->id_car_mark)
                        ->get();

                    $rows = [];

                    foreach ($models as $model) {
                        $rows[] = [
                            "id" => $model->id,
                            "name" => $model->name,
                            "name_rus" => $model->name_rus,
                            "slug" => $model->slug,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;

                case 'price':

                    if (is_numeric($request->id_model) && is_numeric($request->id_modification) && is_numeric($request->id_complectation)) {
                        if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->get()->count() > 0) {
                            if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->update(['price' => trim($request->price)])) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        } else {
                            $input['id_model'] = $request->id_model;
                            $input['id_modification'] = $request->id_modification;
                            $input['id_complectation'] = $request->id_complectation;
                            $input['price'] = trim($request->price);

                            if (CatalogPack::create($input)) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        }
                    }

                    break;

                case 'prev_price':

                    if (is_numeric($request->id_model) && is_numeric($request->id_modification) && is_numeric($request->id_complectation)) {
                        if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->get()->count() > 0) {
                            if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->update(['prev_price' => trim($request->prev_price)])) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        } else {
                            $input['id_model'] = $request->id_model;
                            $input['id_modification'] = $request->id_modification;
                            $input['id_complectation'] = $request->id_complectation;
                            $input['prev_price'] = trim($request->prev_price);

                            if (CatalogPack::create($input)) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        }
                    }

                    break;

                case 'best_price':

                    if (is_numeric($request->id_model) && is_numeric($request->id_modification) && is_numeric($request->id_complectation)) {
                        if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->get()->count() > 0) {
                            if (CatalogPack::where('id_modification', $request->id_modification)->where('id_complectation', $request->id_complectation)->where('id_model', $request->id_model)->update(['best_price' => $request->input('best_price') ? 1 : 0])) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        } else {
                            $input['id_model'] = $request->id_model;
                            $input['id_modification'] = $request->id_modification;
                            $input['id_complectation'] = $request->id_complectation;
                            $input['best_price'] = $request->prev_price;

                            if (CatalogPack::create($input)) {
                                return response()->json(['success' => 'Данные обнавлены']);
                            } else {
                                return response()->json(['error' => 'Ошибка веб приложения! Действия не были выполнены.']);
                            }
                        }
                    }

                    break;

                case 'complectation':

                    $json = [];

                    foreach (CatalogParameterValue::where('name', 'like', '%' . $request->q . '%')->get()->toArray() as $parameterValue) {
                        $json[] = ['id' => $parameterValue['id'], 'text' => $parameterValue['name']];
                    }

                    return response()->json($json);

                    break;

                case 'list_complectation':

                    $list = explode( "\n",  $request->list);

                    foreach ($list as $parameter) {
                        $parameter = trim($parameter);


                       if(CatalogParameterValue::where('name', 'like', $parameter)->count() > 0)
                       {


                           $row = CatalogParameterValue::where('name', 'like', $parameter)->first()->toArray();


                           if ($row['id']) {
                               if (CatalogParameterComplectation::where('id_complectation', $request->id_complectation)->where('id_parameter', $row['id'])->count() == 0)  {

                                   var_dump($row);
                                   $ParameterComplectation = new CatalogParameterComplectation;
                                   $ParameterComplectation->id_complectation = $request->id_complectation;
                                   $ParameterComplectation->id_parameter = $row['id'];
                                   $ParameterComplectation->save();
                               }
                           }


                       }
                    }

                    break;

            }
        }
    }
}