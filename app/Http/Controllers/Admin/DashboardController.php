<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Page;
use App\User;
use App\UserReview;
use App\RequestCredit;
use App\RequestTradeIn;
use App\CarMark;
use App\CarModel;

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

        return view('admin.dashboard')->with(compact('users', 'packages', 'features', 'pages', 'posts', 'reviews', 'images', 'requestcredits', 'requesttradeins', 'carmarks'));
    }

    /**
     * @param Request $request
     * @param UserReview $userReview
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(Request $request, UserReview $userReview)
    {
        if (isset($request->action)) {
            switch($request->action) {
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

                    foreach($marks as $mark) {
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

                    foreach($models as $model) {
                        $rows[] = [
                            "id"   => $model->id,
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

                    foreach($modifications as $modification) {
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

                    foreach($models as $model) {
                        $rows[] = [
                            "id"   => $model->id,
                            "name" => $model->name,
                            "name_rus" => $model->name_rus,
                            "slug" => $model->slug,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;




            }
        }
    }
}