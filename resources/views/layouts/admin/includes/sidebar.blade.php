<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <a href="{{ url('/') }}"><img src="{{ asset(getSetting('SITE_LOGO')) }}" class="" alt="Logo"></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Главное меню</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active': '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Панель управления</span>
                </a>
            </li>
            <li class="{{ Request::is('/') ? 'active': '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-desktop"></i> <span>Перейти на сайт</span>
                </a>
            </li>

            <li class="treeview {{ Request::is('admin/user*') ? 'active': '' || Request::is('admin/role*') ? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Пользователи</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/users')? 'active': '' }}">
                        <a href="{{ url('admin/users') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/users/create')? 'active': '' }}">
                        <a href="{{ url('admin/users/create') }}">
                            <i class="fa fa-plus"></i> <span>Добавить</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/role*')? 'active': '' }}">
                        <a href="#"><i class="fa fa-key"></i> Настройки ролей <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('admin/roles')? 'active': '' }}"><a
                                        href="{{ url('admin/roles') }}"><i class="fa fa-list"></i> Управление ролями</a></li>
                            <li class="{{ Request::is('admin/roles/create')? 'active': '' }}"><a
                                        href="{{ url('admin/roles/create') }}"><i class="fa fa-plus"></i> Добавить роль</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/carmark*') ? 'active': '' || Request::is('admin/carmodel*') ? 'active': '' || Request::is('admin/carmodification*') ? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span>Каталог производителей<br> и моделей</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/carmarks') ? 'active': '' }}">
                        <a href="{{ url('admin/carmarks') }}">
                            <i class="fa fa-list"></i> <span>Марка</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/carmarks/create') ? 'active': '' }}">
                        <a href="{{ url('admin/carmarks/create') }}">
                            <i class="fa fa-plus"></i> <span>Добавить марку</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/carmarks/import') ? 'active': '' }}">
                        <a href="{{ url('admin/carmarks/import') }}">
                            <i class="fa fa-download"></i> <span>Импорт</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/catalogcar*')? 'active': '' || Request::is('admin/catalogmark*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-automobile"></i> <span>Автомобили</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/catalogmark*')? 'active': '' }}">
                        <a href="#"><i class="fa fa-key"></i> Список производителей <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('admin/catalogmarks')? 'active': '' }}"><a
                                        href="{{ url('admin/catalogmarks') }}"><i class="fa fa-list"></i> Администрирование</a></li>
                            <li class="{{ Request::is('admin/catalogmarks/create')? 'active' : '' }}"><a
                                        href="{{ url('admin/catalogmarks/create') }}"><i class="fa fa-plus"></i> Добавить производителя</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/page*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-files-o"></i> <span>Контент</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/pages')? 'active': '' }}">
                        <a href="{{ url('admin/pages') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/pages/create')? 'active': '' }}">
                        <a href="{{ url('admin/pages/create') }}">
                            <i class="fa fa-plus"></i> <span>Добавить контент</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/review*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-comments"></i> <span>Отзывы</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/reviews')? 'active': '' }}">
                        <a href="{{ url('admin/reviews') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/image*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-photo"></i> <span>Фотографии</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/images')? 'active': '' }}">
                        <a href="{{ url('admin/images') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/callback*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-photo"></i> <span>Заявки на обратный звонок</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/callbacks')? 'active': '' }}">
                        <a href="{{ url('admin/callbacks') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/requesttradein*') || Request::is('admin/requestcredit*') ||  Request::is('admin/requestusedcarcredit*') ? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-bell-o"></i> <span>Заявки</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/requesttradeins')? 'active': '' }}">
                        <a href="{{ url('admin/requesttradeins') }}">
                            <i class="fa fa-list"></i> <span>Заявки на Trade-in</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/requestcredits')? 'active': '' }}">
                        <a href="{{ url('admin/requestcredits') }}">
                            <i class="fa fa-list"></i> <span>Заявки на автокредит</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('admin/requestusedcarcredits')? 'active': '' }}">
                        <a href="{{ url('admin/requestusedcarcredits') }}">
                            <i class="fa fa-list"></i> <span>Заявки на автокредит<br>(автомобили с пробегом)</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ Request::is('admin/menu*')? 'active': '' }}">
                <a href="#"><i class="fa fa-list-alt"></i> Меню <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/menus')? 'active': '' }}"><a href="{{ url('admin/menus') }}"><i class="fa fa-list"></i> Управление меню</a></li>
                    <li class="{{ Request::is('admin/menus/create')? 'active': '' }}"><a href="{{ url('admin/menus/create') }}"><i class="fa fa-plus"></i> Добавить меню</a></li>
                </ul>
            </li>
            <li class="treeview {{ Request::is('admin/setting*')? 'active': '' }}">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>Настройки</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('admin/settings')? 'active': '' }}">
                        <a href="{{ url('admin/settings') }}">
                            <i class="fa fa-list"></i> <span>Администрирование</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/settings/create')? 'active': '' }}">
                        <a href="{{ url('admin/settings/create') }}">
                            <i class="fa fa-plus"></i> <span>Добавить настройки</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->