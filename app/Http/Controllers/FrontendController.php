<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestCreditsRequest;
use App\Http\Requests\RequestTradeInsRequest;
use App\Http\Requests\UserReviewsRequest;
use App\Http\Requests\CallbacksRequest;
use App\Page;
use App\CatalogMark;
use App\CatalogModel;
use App\CatalogModification;

use App\CarMark;


use App\CarModel;
use App\UserReview;
use App\GeoRegion;
use App\RequestCredit;
use App\RequestTradeIn;
use App\Callback;
use Intervention\Image\Facades\Image as ImageInt;

class FrontendController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $marks = CatalogMark::all();
        $news = Page::published()->post()->take(3)->get();

        return view('frontend.index', compact('marks', 'news'))->with('title', 'Главная');
    }

    public function components()
    {
        return view('frontend.components');
    }

    /**
     * @param CallbacksRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $from_time = $request->input('from_time');
        $to_time = $request->input('to_time');
        $to_email = getSetting('CONTACT_EMAIL');



        /*
        \Mail::send('callback.callback',
            [
                'name'  => $name,
                'phone' => $phone,
                'from'  => $from_time,
                'to'    => $to_time,
                'time' => date("m.d.y H:m"),
                'email' => 'wrwr@ada.ru'
            ],
            function ($message) use ($to_email) {
                $message->to($to_email, getSetting('SITE_TITLE') . ' Заявка на обратный звонок')->subject('Заявка на обратный звонок (' . getSetting('SITE_TITLE') . ')');
            }
        );
        */

        $callBack = Callback::create($request->except('_token'));
        $callBack->ip = getIP();
        $callBack->save();
        return redirect('/contacts')->with('success', 'Ваша заявка на обратный звонок отправлена. Мы свяжемся с Вами в ближайшее время!');
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function news($slug = '')
    {
        $post = Page::whereSlug($slug)->published()->post()->get()->first();

        if ($post) {
            return view('frontend.post')->with(compact('post'));
        }

        abort(404);
    }

    /**
     * @return $this
     */
    public function allNews()
    {
        $news = Page::published()->published()->post()->paginate(10);

        return view('frontend.allnews', compact('news'))->with('Все новости');
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function staticPages($slug = '')
    {
        $marks = CatalogMark::all();
        $news = Page::published()->post()->take(3)->get();

        $page = Page::whereSlug($slug)->published()->page()->get()->first();

        if ($page) {
            return view('frontend.page', compact('page', 'marks', 'news'))->with('title', $page->title);
        }

        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(Request $request)
    {
        if (isset($request->action)) {
            switch($request->action) {
                case 'search_mark':

                    $search_mark = trim(strip_tags(stripcslashes(htmlspecialchars($request->mark))));

                    $marks = CarMark::where('published', 1)
                            ->where('name', 'LIKE', '%' . $search_mark . '%')
                            ->get();

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

                    $models = CarModel::where('published', 1)
                        ->where('id_car_mark', $request->id_car_mark)
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

                    $modifications = CatalogModification::where('id_model', $request->id_model)
                        ->get();

                    $rows = [];

                    foreach($modifications as $modification) {
                        $rows[] = [
                            "id" => $modification->id,
                            "name" => $modification->name,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;

                case 'get_models':

                    $models = CatalogModel::where('published', 1)
                        ->where('id_car_mark', $request->id_car_mark)
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

                case 'search_registration':

                    $search_region = trim(strip_tags(stripcslashes(htmlspecialchars($request->registration))));

                    $regions = GeoRegion::where('id_country', 149)
                        ->where('name_ru', 'LIKE', '%' .  $search_region . '%')
                        ->get();

                    $rows = [];

                    foreach($regions as $region) {
                        $rows[] = [
                            "id"   => $region->id,
                            "name" => $region->name_ru,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                    break;


                case 'get_model_info':

                    $model = CarModel::where('published', 1)
                            ->where('id', $request->id)
                            ->first()
                            ->toArray();

                    return response()->json($model);

                break;
            }
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reviews()
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->take(23)
            ->get();

        $reviews = UserReview::where('published', 1)
            ->paginate(5);

        return view('frontend.reviews', compact('marks','reviews'))->with(['title' => 'Отзывы']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewsSubmit(UserReviewsRequest $request)
    {
        $userReview = UserReview::create($request->except('_token'));
        $userReview->save();

        return redirect('/reviews')->with(['success' => 'Ваш коментарий отправлен. После проверки модератора он будет доступен!']);
    }

    public function allAuto()
    {
        return view('frontend.auto')->with('title', 'Автомобили с пробегом');
    }

    public function mark($mark)
    {
        $marks = CatalogMark::all();

        return view('frontend.auto.mark', compact('marks'))->with('title', 'Все модели: ' . $mark);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function credit(Request $request)
    {
        $marks = CatalogMark::all();

        $mark_search = CatalogMark::select(['id', 'name'])
            ->where('published', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        $mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $mark_options[$mark['id']] = $mark['name'];
        }

        $model_options[null] = 'Модель';

        if (isset($request->trade_in_mark)) {
            $models_search = CatalogModel::where('published', 1)
                ->where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $model_options[$model['id']] = $model['name'];
            }
        }

        $complectation_options[null] = 'Комплектация';

        return view('frontend.credit', compact('marks', 'mark_options', 'model_options', 'complectation_options'))->with('title', 'Заявка на автокредит');
    }

    /**
     * @param RequestCreditsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestCredit(RequestCreditsRequest $request)
    {
        $request->request->remove('agree');

        $mark = CarMark::select(['name'])->where('id', $request->mark)->first()->toArray();
        $model = CarModel::select(['name'])->where('id', $request->model)->first()->toArray();

        $requestCredit = RequestCredit::create($request->except('_token'));
        $requestCredit->mark = $mark['name'];
        $requestCredit->model = $model['name'];
        $requestCredit->ip = getIP();
        $requestCredit->save();
        return redirect('/credit')->with('success', 'Ваша заявка на автокредит отправлена. Мы свяжемся с Вами в ближайшее время!');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function tradeIn(Request $request)
    {
        $marks = CatalogMark::all();

        $mark_search = CatalogMark::select(['id', 'name'])
            ->where('published', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        $trade_in_mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $trade_in_mark_options[$mark['id']] = $mark['name'];
        }

        $trade_in_model_options[null] = 'Модель';

        if (isset($request->trade_in_mark)) {
            $models_search = CatalogModel::where('published', 1)
                ->where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $trade_in_model_options[$model['id']] = $model['name'];
            }
        }

        $trade_in_complectation_options[null] = 'Комплектация';


        $mark_search = CarMark::select(['id', 'name'])
            ->orderBy('name')
            ->get()
            ->toArray();

        $mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $mark_options[$mark['id']] = $mark['name'];
        }

        $model_options[null] = 'Модель';

        if (isset($request->mark)) {
            $models_search = CarModel::where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $model_options[$model['id']] = $model['name'];
            }
        }

        return view('frontend.tradein', compact('marks', 'trade_in_mark_options', 'trade_in_model_options', 'trade_in_complectation_options', 'mark_options', 'model_options'))->with('title', 'Заявка на Trade-in');
    }

    /**
     * @param RequestTradeInsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestTradein(RequestTradeInsRequest $request)
    {
        $request->request->remove('agree');
        $mark = CarMark::select(['name'])->where('id', $request->mark)->first()->toArray();
        $model = CarModel::select(['name'])->where('id', $request->model)->first()->toArray();
        $requestTradeIn = RequestTradeIn::create($request->except('_token'));
        $requestTradeIn->mark = $mark['name'];
        $requestTradeIn->model = $model['name'];
        $requestTradeIn->ip = getIP();
        $requestTradeIn->save();
        return redirect('/tradein')->with('success', 'Ваша заявка на Trade-In отправлена. Мы свяжемся с Вами в ближайшее время!');
    }

    public function contact()
    {
        $marks = CatalogMark::all();
        return view('frontend.contact', compact('marks'))->with('title', 'Контакты');
    }
}
