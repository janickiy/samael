<?php

namespace App\Http\Controllers\Admin;

use App\CatalogMark;
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
use App\Image;
use App\RequestTradeIn;
use App\RequestCredit;
use App\Callback;


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
                $mark = CarMark::select(['name'])->where('id', $requestTradeIn->trade_in_mark)->first()->toArray();
                $model = CarModel::select(['name'])->where('id', $requestTradeIn->trade_in_model)->first()->toArray();

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
                $carmark = '<a href="' . url('admin/catalogmodels/catalogmark/' . $catalogMarks->id . '/') .'">' . $catalogMarks->name . '</a>';

                if (file_exists(public_path() . $catalogMarks->logo)) $carmark .= ' <img height="23" src="' . $catalogMarks->logo . '">';

                return  $carmark;
            })


            ->addColumn('status', function ($catalogMarks) {
                return $catalogMarks->published ? 'опубликован' : 'не опубликован';
            })

            ->addColumn('actions', function ($catalogMarks) {

                $editBtn = '<a style="margin-right: 0.2em;" href="' . url('admin/catalogmarks/' . $catalogMarks->id . '/edit/') . '"  title="Редактировать"><i class="fa fa-2 fa-pencil"></i></a>';
                $deleteBtn = '&nbsp;<a href="' . url('admin/catalogmarks/' . $catalogMarks->id) . '" class="message_box text-danger" data-box="#message-box-delete" data-action="DELETE" title="Удалить навсегда"><i class="fa fa-2 fa-remove"></i></a>';

                return $editBtn . $deleteBtn;
            })
            ->make(true);
    }

}