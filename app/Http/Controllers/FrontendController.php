<?php

namespace App\Http\Controllers;

use App\CatalogColor;
use App\CatalogPack;
use App\CatalogParameterValue;
use App\ImageGallery;
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

        $specialoffers = CatalogModel::selectRaw('catalog_models.id, catalog_models.name as model, catalog_models.slug as model_slug, catalog_marks.slug as mark_slug, catalog_models.image, catalog_marks.name as mark, catalog_models.body_type, MIN(catalog_packs.price) as price')
        ->where('catalog_models.published', 1)
            ->where('catalog_models.special', 1)
            ->leftJoin('catalog_marks', 'catalog_marks.id', '=', 'catalog_models.id_car_mark')
            ->leftJoin('catalog_packs', 'catalog_packs.id_model', '=', 'catalog_models.id')
            ->orderByRaw('RAND()')
            ->groupBy('catalog_models.id')
            ->take(8)
            ->get();


        return view('frontend.index', compact('marks', 'news', 'specialoffers'))->with('title', 'Главная');
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
        return back()->with('success', 'Ваша заявка на обратный звонок отправлена. Мы свяжемся с Вами в ближайшее время!');
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

    public function about()
    {
        $marks = CatalogMark::all();
        $news = Page::published()->post()->take(3)->get();
        $page = Page::whereSlug('about')->published()->page()->get()->first();

        return view('frontend.page', compact('page', 'marks', 'news'))->with('title', $page->title);
    }

    public function documents()
    {
        $marks = CatalogMark::all();
        $news = Page::published()->post()->take(3)->get();
        $page = Page::whereSlug('documents')->published()->page()->get()->first();

        return view('frontend.page', compact('page', 'marks', 'news'))->with('title', $page->title);
    }

    public function our_clients()
    {
        $marks = CatalogMark::all();
        $news = Page::published()->post()->take(3)->get();
        $page = Page::whereSlug('our_clients')->published()->page()->get()->first();

        return view('frontend.page', compact('page', 'marks', 'news'))->with('title', $page->title);
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

                case 'get_car_models':

                    $models = CarModel::where('id_car_mark', $request->id_car_mark)->get();

                    $rows = [];

                    foreach($models as $model) {
                        $rows[] = [
                            "id"   => $model->id,
                            "name" => $model->name,
                        ];
                    }

                    return response()->json(['item' => $rows]);

                break;


                case 'get_parameters':






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
        $marks = CatalogMark::all();

        $newcars = CatalogModel::select(['catalog_models.id', 'catalog_models.name as model', 'catalog_models.name_rus', 'catalog_models.slug', 'catalog_models.image', 'catalog_marks.name as mark', 'catalog_marks.slug as mark_slug', 'catalog_models.slug as model_slug'])
                    ->where('catalog_models.published', 1)
                    ->leftJoin('catalog_marks', 'catalog_marks.id', '=', 'catalog_models.id_car_mark')
                    ->groupBy('catalog_models.id')
                    ->paginate(8);

        return view('frontend.auto', compact('marks', 'newcars'))->with('title', 'Новые автомобили');
    }

    /**
     * @param $mark
     * @return $this
     */
    public function mark($slug)
    {
        $marks = CatalogMark::all();
        $mark = CatalogMark::where('slug', $slug)->where('published', 1)->first();

        if ($mark) {
            $models_list = CatalogModel::selectRaw('catalog_models.id, catalog_models.name as model, catalog_models.name_rus, catalog_models.slug, catalog_models.image, catalog_marks.name as mark, catalog_marks.slug as mark_slug, catalog_models.slug as model_slug, MIN(catalog_packs.price) as price')
                ->where('catalog_models.published', 1)
                ->where('catalog_models.id_car_mark', $mark->id)
                ->join('catalog_marks', 'catalog_marks.id', '=', 'catalog_models.id_car_mark')
                ->leftJoin('catalog_packs', 'catalog_packs.id_model', '=', 'catalog_models.id')
                ->groupBy('catalog_models.id')
                ->orderBy('catalog_models.id')
                ->paginate(10);

            return view('frontend.auto.mark', compact('marks', 'models_list', 'mark'))->with('title', '');
        }

        abort(404);
    }

    /**
     * @param $mark
     * @param $model
     * @return $this
     */
    public function model($mark, $model)
    {
        $marks = CatalogMark::all();

        $car = CatalogModel::select(['catalog_models.id', 'catalog_models.body_type', 'catalog_marks.id as id_car_mark', 'catalog_models.annotation', 'catalog_models.bannerText', 'catalog_models.parametersContent', 'catalog_models.galleryContent', 'catalog_models.name as model', 'catalog_models.name_rus', 'catalog_models.slug', 'catalog_models.image', 'catalog_marks.name as mark', 'catalog_marks.slug as mark_slug', 'catalog_models.slug as model_slug'])
            ->where('catalog_models.slug', $model)
            ->where('catalog_models.published', 1)
            ->join('catalog_marks', 'catalog_marks.id', '=', 'catalog_models.id_car_mark')
            ->first();

        if ($car) {
            $colors = CatalogColor::where('id_model', $car->id)->get();

            $min_price = CatalogPack::selectRaw('MIN(price)')
                ->where('id_model', $car->id)
                ->get()
                ->toArray();

            $min_prevprice = CatalogPack::selectRaw('MIN(prev_price)')
                ->where('id_model', $car->id)
                ->get()
                ->toArray();

            $price = $min_price[0]["MIN(price)"];
            $prev_price = $min_prevprice[0]["MIN(prev_price)"];

            $modifications = CatalogModification::where('published', 1)->where('id_model', $car->id)->get()->toArray();

            $options = ['length' => 'Длина, мм',
                        'width' => 'Ширина, мм',
                        'height' => 'Высота, мм',
                        'wheel_base' => 'Колесная база, мм',
                        'front_rut' => 'Передняя колея колес, мм',
                        'back_rut' => 'Задняя колея колес, мм',
                        'front_overhang' => 'Передний свес, мм',
                        'back_overhang' => 'Задний свес, мм',
                        'trunk_volume_min' => 'Минимальный объем багажного отделения, л',
                        'trunk_volume_max' => 'Максимальный объем багажного отделения, л',
                        'tank_volume' => 'Объем топливного бака, л',
                        'front_brakes' => 'Передние тормоза (тип, размер)',
                        'back_brakes' => 'Задние тормоза (тип, размер)',
                        'front_suspension' => 'Передняя подвеска',
                        'back_suspension' => 'Задняя подвеска',
                        'engine_displacement' => 'Объем двигателя, л',
                        'engine_displacement_working_value' => 'Рабочий объем двигателя, см3',
                        'engine_type' => 'Тип двигателя',
                        'gearbox' => 'Коробка передач',
                        'gears' => 'Количество передач',
                        'drive' => 'Тип привода',
                        'power' => 'Мощность, л.с.',
                        'consume_city' => 'Расход топлива в городе, л/100 км',
                        'consume_track' => 'Расход топлива на трассе, л/100 км',
                        'consume_mixed' => 'Смешанный расход топлива, л/100 км',
                        'acceleration_100km' => 'Разгон от 0 до 100 км/ч, сек.',
                        'max_speed' => 'Максимальная скорость, км/ч',
                        'clearance' => 'Дорожный просвет, мм',
                        'min_mass' => 'Минимальная масса, кг',
                        'max_mass' => 'Максимальная масса, кг',
                        'trailer_mass' => 'Допустимая масса прицепа без тормозов, кг',
                        ];

            $similarcars = CatalogModel::selectRaw('catalog_models.id, catalog_models.name as model, catalog_models.slug as model_slug, catalog_marks.slug as mark_slug, catalog_models.image, catalog_marks.name as mark, catalog_models.body_type, MIN(catalog_packs.price) as price')
                ->where('catalog_models.published', 1)
                ->where('catalog_models.id_car_mark', $car->id_car_mark)
                ->where('catalog_models.body_type', $car->body_type)
                ->leftJoin('catalog_marks', 'catalog_marks.id', '=', 'catalog_models.id_car_mark')
                ->leftJoin('catalog_packs', 'catalog_packs.id_model', '=', 'catalog_models.id')
                ->orderByRaw('RAND()')
                ->groupBy('catalog_models.id')
                ->take(8)
                ->get();

            $gallery_pics = ImageGallery::where('id_model', $car->id)->get();

            return view('frontend.auto.model', compact('marks', 'car', 'colors', 'price', 'prev_price', 'modifications', 'options', 'similarcars', 'gallery_pics'))->with('title', '');
        }

        abort(404);
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
