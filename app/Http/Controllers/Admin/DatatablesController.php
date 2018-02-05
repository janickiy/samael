<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Page;
use Yajra\Datatables\Datatables;
use App\User;
use App\Setting;
use App\Role;
use App\UserReview;
use App\CarMark;
use App\CarModel;
use App\CatalogModel;
use App\Image;
use App\RequestTradeIn;
use App\RequestCredit;
use App\CatalogMark;
use App\CatalogModification;
use App\CatalogComplectation;
use App\Callback;
use App\CatalogParameterCategory;
use App\CatalogParameterValue;


class DatatablesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        $users = User::all();

        return Datatables::of($users)
            ->editColumn('name', '<a href="{{ url(\'admin/users/\'.$id) }}"><b>{{ $name }}</b></a>')
            ->editColumn('role_id', function ($user) {
                if (!is_null($user->role)) {
                    return $user->role->name;
                } else {
                    return '-';
                }
            })
            ->editColumn('package_id', function ($user) {
                if (!is_null($user->package)) {
                    return $user->package->name;
                } else {
                    return '-';
                }
            })
            ->addColumn('avatar', function ($user) {
                return '<a href="' . url('admin/users/' . $user->id) . '"><img src="' . asset($user->avatar) . '" style="height:50px;" class="img-circle" alt="Аватар"></a>';
            })
            ->addColumn('actions', function ($user) {
                if (\Auth::user()->role->name == 'Admin') {
                    $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/users/' . $user->id . '/edit') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                    if (!is_null($user->role) && $user->role->name != 'Admin') {
                        $deleteBtn = '&nbsp;<a href="' . url('admin/users/' . $user->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="Удалить" title="Удалить"><i class="fa fa-2 fa-remove"></i></i></a>';
                    } else {
                        $deleteBtn = '';
                    }
                }
                $buttons = '' . $editBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        $settings = Setting::all();

        return Datatables::of($settings)
            ->editColumn('value', function ($setting) {
                return htmlentities(strlen($setting->getOriginal('value')) > 50 ? substr($setting->getOriginal('value'), 0, 50) : $setting->getOriginal('value'));
            })
            ->addColumn('actions', function ($setting) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/settings/' . $setting->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';

                return $editBtn;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        $roles = Role::all();

        return Datatables::of($roles)
            ->editColumn('routes', function ($role) {
                return htmlentities(strlen($role->getOriginal('routes')) > 50 ? substr($role->getOriginal('routes'), 0, 50) : $role->getOriginal('routes'));
            })
            ->addColumn('actions', function ($role) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/roles/' . $role->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '';
                if ($role->name != 'Admin') {
                    $deleteBtn = '&nbsp;<a href="' . url('admin/roles/' . $role->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                }
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getMenus()
    {
        $menus = Menu::all();

        return Datatables::of($menus)
            ->addColumn('actions', function ($menu) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/menus/' . $menu->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/menus/' . $menu->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        $userReviews = UserReview::all();

        return Datatables::of($userReviews)
            ->addColumn('status', function ($userReviews) {
                return $userReviews->published ? 'опубликован' : 'не опубликован';
            })
            ->addColumn('actions', function ($userReviews) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/reviews/' . $userReviews->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $approveBtn = $userReviews->published ? '' : '&nbsp;<a href="' . url('admin/ajax?action=approve&id=' . $userReviews->id) . '" class="approve-review text-success"  data-id="' . $userReviews->id . '" title="Опубликовать"><i class="fa fa-2 fa-check"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/reviews/' . $userReviews->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $approveBtn . $deleteBtn;
            })
            ->make(true);

    }

    /**
     * @return mixed
     */
    public function getCarmarks()
    {
        $carMarks = CarMark::all();

        return Datatables::of($carMarks)

            ->addColumn('carmodel', function ($carMarks) {
                return '<a href="' . url('admin/carmodels/carmark/' . $carMarks->id . '/') .'">' . $carMarks->name . '</a>';
            })

            ->addColumn('status', function ($carMarks) {
                return $carMarks->published ? 'опубликован' : 'не опубликован';
            })
            ->addColumn('actions', function ($carMarks) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/carmarks/' . $carMarks->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/carmarks/' . $carMarks->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getCarmodels()
    {
        $carModels = CarModel::all();

        return Datatables::of($carModels)

            ->addColumn('actions', function ($carModels) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/carmodels/' . $carModels->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/carmodels/' . $carModels->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCarmarkmodels($id)
    {
        $carModels = CarModel::where('id_car_mark', $id)->get();

        return Datatables::of($carModels)

            ->addColumn('modification', function ($carModels) {
                return $carModels->name;
            })

            ->addColumn('actions', function ($carModels) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/carmodels/' . $carModels->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/carmodels/' . $carModels->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        $pages = Page::all();

        return Datatables::of($pages)
            ->editColumn('title', '<a href="{{ url(\'admin/pages/\'.$id) }}" target="_blank"><b>{{ $title }}</b></a>')
            ->addColumn('actions', function ($page) {
                $editBtn = '<a style="margin-right: 0.1em;" href="' . url('admin/pages/' . $page->id . '/edit') . '"  title="Edit"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/pages/' . $page->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Delete"><i class="fa fa-2 fa-remove"></i></a>';
                $viewBtn = '<a style="margin-right: 0.2em;" href="' . url($page->slug) . '"  title="View" target="blank"><i class="fa fa-2 fa-eye"></i></a>';
                $buttons = '' . $editBtn . $viewBtn . $deleteBtn;
                return $buttons;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        $image = Image::all();

        return Datatables::of($image)

            ->addColumn('image', function ($image) {
                return '<img width="200px" src="' . url('uploads/images/small/' . $image->img) . '">';
            })

            ->addColumn('actions', function ($image) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/images/' . $image->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/images/' . $image->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getRequesttradeins()
    {
        $requestTradeIn = RequestTradeIn::all();

        return Datatables::of($requestTradeIn)
            ->addColumn('request_car', function ($requestTradeIn) {
                $mark = CatalogMark::select(['name'])->where('id', $requestTradeIn->trade_in_mark)->first()->toArray();
                $model = CatalogModel::select(['name'])->where('id', $requestTradeIn->trade_in_model)->first()->toArray();

                return $mark['name'] . ' ' . $model['name'];
            })

            ->addColumn('actions', function ($requestTradeIn) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/requesttradeins/' . $requestTradeIn->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/requesttradeins/' . $requestTradeIn->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getRequestcredits()
    {
        $requestCredit = RequestCredit::all();

        return Datatables::of($requestCredit)

            ->addColumn('status', function ($requestCredit) {
                return $requestCredit->status ? 'да' : 'нет';
            })

            ->addColumn('actions', function ($requestCredit) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/requestcredits/' . $requestCredit->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/requestcredits/' . $requestCredit->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })->make(true);
    }


    /**
     * @return mixed
     */
    public function getCallbacks()
    {
        $callBack = Callback::all();

        return Datatables::of($callBack)

            ->addColumn('time', function ($callBack) {
                return $callBack->from_time . ' - ' . $callBack->to_time;
            })

            ->addColumn('actions', function ($callBack) {
                $deleteBtn = '&nbsp;<a href="' . url('admin/callbacks/' . $callBack->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $deleteBtn;
            })->make(true);
    }

    /**
     * @return mixed
     */
    public function getCatalogmarks()
    {
        $catalogMarks = CatalogMark::all();

        return Datatables::of($catalogMarks)

            ->addColumn('carmark', function ($catalogMarks) {
                $carmark = '<a href="' . url('admin/catalog/models/mark/' . $catalogMarks->id . '/') .'">' . $catalogMarks->name . '</a>';

                if (file_exists(public_path() . $catalogMarks->logo)) $carmark .= ' <img height="23" src="' . $catalogMarks->logo . '">';

                return  $carmark;
            })


            ->addColumn('status', function ($catalogMarks) {
                return $catalogMarks->published ? 'опубликован' : 'не опубликован';
            })

            ->addColumn('actions', function ($catalogMarks) {

                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/marks/' . $catalogMarks->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/marks/' . $catalogMarks->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';

                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCatalogmarkmodels($id)
    {
        $catalogModels = CatalogModel::where('id_car_mark', $id)->get();

        return Datatables::of($catalogModels)

            ->addColumn('image', function ($catalogModels) {
                return file_exists(public_path() . $catalogModels->image) ? '<a class="btn btn-default btn-xs" target="_blank" href="' . url($catalogModels->image). '" title="Просмотр"><span class="fa fa-eye"></span></a>' : '';
            })

            ->addColumn('status', function ($catalogModels) {
                return $catalogModels->published ? 'опубликован' : 'не опубликован';
            })

            ->addColumn('actions', function ($catalogModels) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/models/' . $catalogModels->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/models/' . $catalogModels->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';

                $items = '<br><a class="btn btn-default btn-sm" href="' . url('admin/catalog/models/model/' . $catalogModels->id . '/bodies') . '" title="Кузова"><span class="fa fa-th-list"> Кузова</span></a><br>';
                $items .= '<a class="btn btn-default btn-sm" href="' . url('admin/catalog/models/model/' . $catalogModels->id . '/modifications') . '" title="Модификации"><span class="fa fa-th-list"> Модификации</span></a><br>';
                $items .= '<a class="btn btn-default btn-sm" href="' . url('admin/catalog/models/model/' . $catalogModels->id . '/complectations') . '" title="Комплектации"><span class="fa fa-th-list"> Комплектации</span></a><br>';
                $items .= '<a class="btn btn-default btn-sm" href="' . url('admin/catalog/models/model/' . $catalogModels->id . '/packs') . '" title="Цены"><span class="fa fa-th-list"> Цены</span></a>';

                return $editBtn . $deleteBtn . $items;
            })
            ->make(true);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCatalogmodifications($id)
    {
        $catalogModifications = CatalogModification::where('id_model', $id)->get();

        return Datatables::of($catalogModifications)

            ->addColumn('status', function ($catalogModifications) {
                return $catalogModifications->published ? 'опубликован' : 'не опубликован';
            })

            ->addColumn('bodyType', function ($catalogModifications) {
                return bodyType($catalogModifications->body_type);
            })

            ->addColumn('actions', function ($catalogModifications) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/modifications/' . $catalogModifications->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/modifications/' . $catalogModifications->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCatalogcomplectations($id)
    {
        $catalogComplectations = CatalogComplectation::where('id_model', $id)->get();

        return Datatables::of($catalogComplectations)

            ->addColumn('status', function ($catalogComplectations) {
                return $catalogComplectations->published ? 'опубликован' : 'не опубликован';
            })

            ->addColumn('actions', function ($catalogComplectations) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/complectations/' . $catalogComplectations->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/complectations/' . $catalogComplectations->id . '/edit/') . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function getParametercategories()
    {
        $parameterCategories = CatalogParameterCategory::all();

        return Datatables::of($parameterCategories)

            ->addColumn('parameter', function ($parameterCategories) {
                return '<a href="' . url('admin/catalog/parametervalues/category/' . $parameterCategories->id . '/') .'">' . $parameterCategories->name . '</a>';
            })

            ->addColumn('actions', function ($parameterCategories) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/parametercategories/' . $parameterCategories->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/parametercategories/' . $parameterCategories->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

    public function getParametervalues($id)
    {
        $catalogParameterValues = CatalogParameterValue::where('id_category', $id)->get();

        return Datatables::of($catalogParameterValues)

            ->addColumn('actions', function ($catalogParameterValues) {
                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalog/parametervalues/' . $catalogParameterValues->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalog/parametervalues/' . $catalogParameterValues->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';
                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }
}