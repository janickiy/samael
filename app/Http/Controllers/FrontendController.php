<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestCreditsRequest;
use App\Http\Requests\RequestTradeInsRequest;
use App\Http\Requests\UserReviewsRequest;
use App\Http\Requests\RequestUsedcarCreditsRequest;
use App\Http\Requests\CallbacksRequest;
use App\Page;
use App\CarMark;
use App\CarModel;
use App\CarModification;
use App\UserReview;
use App\GeoRegion;
use App\RequestCredit;
use App\RequestUsedcarCredit;
use App\RequestTradeIn;
use App\CatalogUsedCar;
use App\Callback;
use Intervention\Image\Facades\Image as ImageInt;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->take(23)
            ->get();

        $numberCars = CatalogUsedCar::where('published', 1)
            ->count();

        $soldLastWeek = CatalogUsedCar::where('published', 0)
            ->count();

        $specialOffer = CatalogUsedCar::where('published', 1)
            ->where('special', 1)
            ->orderByRaw('RAND()')
            ->take(7)
            ->get();

        $newCars = CatalogUsedCar::where('published', 1)
            ->orderBy('created_at')
            ->paginate(10);

        $mark_search = CarMark::select(['id', 'name'])
            ->where('published', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        $mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $mark_options[$mark['id']] = $mark['name'];
        }

        $models_options[null] = 'Модель';

        if (isset($request->mark)) {
            $models_search = CarModel::where('published', 1)
                ->where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $models_options[$model['id']] = $model['name'];
            }
        }

        $year = null;

        if (isset($request->model)) {
            $min_year = CarModification::selectRaw('MIN(year_begin)')
                ->where('id_car_model', $request->model)
                ->get()
                ->toArray();

            $max_year = CarModification::selectRaw('MAX(year_end)')
                ->where('id_car_model', $request->model)
                ->get()
                ->toArray();

            $year = ['from' => $min_year[0]["MIN(year_begin)"], 'to' => $max_year[0]["MAX(year_end)"]];
        }

        $usedcars = null;

        if (isset($request->search)) {

            if ($request->mark) $mark_search = CarMark::select(['name'])->where('id', $request->mark)->first()->toArray();
            if ($request->model) $model_search = CarModel::select(['name'])->where('id', $request->model)->first()->toArray();

            if ((isset($request->price_from) && $request->price_from) and (isset($request->price_to) && $request->price_to)) {
                $usedcars = CatalogUsedCar::where('published', 1)
                    ->where('mark', isset($request->mark) && $request->mark ? 'like' : 'not like', isset($request->mark) && $request->mark ? $mark_search['name'] : '')
                    ->where('model', isset($request->model) && $request->model ? 'like' : 'not like',  isset($request->model) && $request->model ? $model_search['name'] : '')
                    ->where('gearbox', isset($request->gearbox) && $request->gearbox ? 'like' : 'not like', isset($request->gearbox) && $request->gearbox ? $request->gearbox : '')
                    ->where('year', isset($request->year) && $request->year ? '>' : 'not like', isset($request->year) && $request->year ? $request->year : '')
                    ->whereBetween('price', [$request->price_from, $request->price_to])
                    ->paginate(5);
            } else {
                $usedcars = CatalogUsedCar::where('published', 1)
                    ->where('mark', isset($request->mark) && $request->mark ? 'like' : 'not like', isset($request->mark) && $request->mark ? $mark_search['name'] : '')
                    ->where('model', isset($request->model) && $request->model ? 'like' : 'not like',  isset($request->model) && $request->model ? $model_search['name'] : '')
                    ->where('gearbox', isset($request->gearbox) && $request->gearbox ? 'like' : 'not like', isset($request->gearbox) && $request->gearbox ? $request->gearbox : '')
                    ->where('year', isset($request->year) && $request->year ? '>' : 'not like', isset($request->year) && $request->year ? $request->year : '')
                    ->paginate(5);
            }
        }

        return view('frontend.index', compact('marks', 'numberCars', 'soldLastWeek', 'specialOffer', 'newCars', 'mark_options', 'request', 'models_options', 'year', 'usedcars'))->with('title', 'Главная');
    }

    public function components()
    {
        return view('frontend.components');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUsSubmit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $form_message = $request->input('message');
        $to_email = \Config::get('app.contact_email');

        \Mail::send('emails.contact',
            [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'form_message' => $form_message
            ],
            function ($message) use ($to_email) {
                $message->to($to_email, getSetting('SITE_TITLE') . ' Поддержка')->subject('Сообщение из формы контактов');
            }
        );

        return redirect('/login')->with(['success' => 'Спасибо что связались с нами!']);
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
    public function post($slug = '')
    {
        $post = Page::whereSlug($slug)->published()->post()->get()->first();
        if ($post) {
            return view('frontend.post')->with(compact('post'));
        }

        abort(404);
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function staticPages($slug = '')
    {
        $page = Page::whereSlug($slug)->published()->page()->get()->first();

        if ($page) {
            return view('frontend.page')->with(compact('page'));
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

                    $models = CarModel::where('published', 1)
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

                case 'get_year':

                    $id_car_model = $request->id_car_model;

                    $min_year = CarModification::selectRaw('MIN(year_begin)')
                                ->where('id_car_model', $id_car_model)
                                ->get()
                                ->toArray();

                    $max_year = CarModification::selectRaw('MAX(year_end)')
                                ->where('id_car_model', $id_car_model)
                                ->get()
                                ->toArray();

                    return response()->json(['min' => $min_year[0]["MIN(year_begin)"], 'max' => $max_year[0]["MAX(year_end)"]]);

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

    public function allUsedAuto()
    {
        $usedCars = CatalogUsedCar::where('published', 1)
            ->paginate(12);

        return view('frontend.auto', compact('usedCars'))->with('title', 'Автомобили с пробегом');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function credit(Request $request)
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->take(23)
            ->get();

        $mark_search = CarMark::select(['id', 'name'])
            ->where('published', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        $mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $mark_options[$mark['id']] = $mark['name'];
        }

        $models_options[null] = 'Модель';

        if (isset($request->mark)) {
            $models_search = CarModel::where('published', 1)
                ->where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $models_options[$model['id']] = $model['name'];
            }
        }

        $models_modification[null] = 'Комлектация';

        if (isset($request->model)) {
            $modifications_search = CarModification::where('id_car_model', $request->model)
                ->get()
                ->toArray();

            foreach ($modifications_search as $modification) {
                $models_modification[$modification['name']] = $modification['name'];
            }
        }

        return view('frontend.credit', compact('marks', 'mark_options', 'models_options', 'models_modification'))->with('title', 'Автокредит');
    }

    /**
     * @param RequestCreditsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestCredit(RequestCreditsRequest $request)
    {
        $request->request->remove('confirmation');
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
     * @param RequestUsedcarCreditsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestUsedCarCredit(RequestUsedcarCreditsRequest $request)
    {
        $usedCar = CatalogUsedCar::where('published', 1)
                    ->where('id', $request->id_car)
                    ->get()
                    ->first();

        if ($usedCar) {
            $requestCredit = RequestUsedcarCredit::create($request->except('_token'));
            $requestCredit->ip = getIP();
            $requestCredit->save();
            return redirect('/auto/used/detail/' . $request->id_car)->with('success', 'Ваша заявка на автокредит отправлена. Мы свяжемся с Вами в ближайшее время!');
        }

        abort(500);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function tradeIn(Request $request)
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->take(23)
            ->get();

        $mark_search = CarMark::select(['id', 'name'])
            ->where('published', 1)
            ->orderBy('name')
            ->get()
            ->toArray();

        $mark_options[null] = 'Марка';

        foreach ($mark_search  as $mark) {
            $mark_options[$mark['id']] = $mark['name'];
        }

        $models_options[null] = 'Модель';

        if (isset($request->mark)) {
            $models_search = CarModel::where('published', 1)
                ->where('id_car_mark', $request->mark)
                ->get()
                ->toArray();

            foreach ($models_search  as $model) {
                $models_options[$model['id']] = $model['name'];
            }
        }

        $year = null;

        if (isset($request->model)) {
            $min_year = CarModification::selectRaw('MIN(year_begin)')
                ->where('id_car_model', $request->model)
                ->get()
                ->toArray();

            $max_year = CarModification::selectRaw('MAX(year_end)')
                ->where('id_car_model', $request->model)
                ->get()
                ->toArray();

            $year = ['from' => $min_year[0]["MIN(year_begin)"], 'to' => $max_year[0]["MAX(year_end)"]];
        }

        return view('frontend.tradein', compact('marks', 'mark_options', 'models_options', 'year'))->with('title', 'Trade-in');
    }

    /**
     * @param RequestTradeInsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestTradein(RequestTradeInsRequest $request)
    {
        $request->request->remove('confirmation');
        $request->request->remove('agree');

        $mark = CarMark::select(['name'])->where('id', $request->mark)->first()->toArray();
        $model = CarModel::select(['name'])->where('id', $request->model)->first()->toArray();

        $image = [];

        if ($request->hasFile('photo')) {
            $small_path = public_path() . PATH_SMALL_TRADEIN;
            $big_path = public_path() . PATH_BIG_TRADEIN;
            $file = $request->file('photo');

            $filename = str_random(20) . '.' . $file->getClientOriginalExtension() ? : 'png';
            $img = ImageInt::make($file);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($small_path . $filename);

            $img->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($big_path . $filename);

            $image = ['small' => PATH_SMALL_TRADEIN . $filename, 'big' => PATH_BIG_TRADEIN . $filename, 'name' => $file->getClientOriginalName()];
        }

        $requestTradeIn = RequestTradeIn::create($request->except('_token'));
        $requestTradeIn->mark = $mark['name'];
        $requestTradeIn->model = $model['name'];
        $requestTradeIn->ip = getIP();
        $requestTradeIn->photo = !empty($image) ? serialize($image) : '';
        $requestTradeIn->save();
        return redirect('/tradein')->with('success', 'Ваша заявка на Trade-In отправлена. Мы свяжемся с Вами в ближайшее время!');
    }

    public function contact()
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->take(23)
            ->get();

        return view('frontend.contact', compact('marks'))->with('title', 'Контакты');
    }

    public function allmarks()
    {
        $marks = CarMark::selectRaw('car_marks.id,car_marks.name,car_marks.slug,count(catalog_used_cars.id) as countusedcars')
            ->where('car_marks.published', 1)
            ->leftJoin('catalog_used_cars', 'car_marks.name', 'like', 'catalog_used_cars.mark')
            ->groupBy('car_marks.id')
            ->orderBy('car_marks.name')
            ->get();

        return view('frontend.allmarks', compact('marks'))->with('title', 'Все марки');
    }

    /**
     * @param $mark
     * @return $this
     */
    public function usedAuto($mark)
    {
        $models = CarModel::select(['car_models.name', 'car_models.slug as model', 'car_marks.slug as mark'])
                    ->where('car_models.published', 1)
                    ->join('car_marks', 'car_marks.id', '=', 'car_models.id_car_mark')
                    ->where('car_marks.slug', $mark)
                    ->get();

        $model_list = CatalogUsedCar::where('mark', 'like', $mark)
            ->where('published', 1)
            ->paginate(10);

        return view('frontend.usedauto.mark', compact('models', 'model_list'))->with('title', 'Все модели: ' . $mark);
    }

    /**
     * @param $mark
     * @param $model
     * @return $this
     */
    public function usedAutoModel($model)
    {
        $modifications = CarModel::select(['car_modifications.id','car_modifications.name','car_modifications.body_type'])
            ->join('car_modifications', 'car_models.id', '=', 'car_modifications.id_car_model')
            ->where('car_models.slug', $model)
            ->where('car_models.published', 1)
            ->get();

        $model_list = CarModel::where('slug', $model)
            ->where('published', 1)
            ->paginate(10);

        return view('frontend.usedauto.model', compact('modifications','model_list'))->with('title', 'Автомобили с пробегом');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usedAutoDetail($id)
    {
        $detail = CatalogUsedCar::where('id', $id)->get()->first();

        if ($detail) {
            $similarCars = CatalogUsedCar::where('published', 1)
                ->where('mark', 'like', $detail->mark)
                ->where('model', 'like', '%' . $detail->model . '%')
                ->orderByRaw('RAND()')
                ->take(5)
                ->get();

            $equipments = unserialize($detail->equipment);
            $images = unserialize($detail->image);

            return view('frontend.usedauto.detail', compact('detail','similarCars', 'equipments', 'images'))->with('title', $detail->mark . ' ' . $detail->model);
        }

        abort(404);
    }
}
