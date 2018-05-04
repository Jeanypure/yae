<?php
use yii\bootstrap\Nav;
use mdm\admin\components\MenuHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php
        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],

                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
        ?>

        <?php
        echo Nav::widget(
            [
                "encodeLabels" => false,
                "options" => ["class" => "sidebar-menu"],
                "items" => MenuHelper::getAssignedMenu(Yii::$app->user->id),
            ]
        );
        ?>

<!--        <ul class="sidebar-menu">-->
<!--            <li class="tree">-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-gears"></i> <span>权限控制</span>-->
<!--                    <i class="fa fa-angle-left pull-right"></i>-->
<!--                </a>-->
<!--                <ul class="tree-menu">-->
<!--                    <li class="tree">-->
<!--                        <a href="/admin">管理员</a>-->
<!--                        <ul class="tree-menu">-->
<!--                            <li><a href="/user"><i class="fa fa-circle-o"></i> 后台用户</a></li>-->
<!--                            <li class="tree">-->
<!--                                <a href="/admin/role">-->
<!--                                    <i class="fa fa-circle-o"></i> 权限 <i class="fa fa-angle-left pull-right"></i>-->
<!--                                </a>-->
<!--                                <ul class="tree-menu">-->
<!--                                    <li><a href="/admin/route"><i class="fa fa-circle-o"></i> 路由</a></li>-->
<!--                                    <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限</a></li>-->
<!--                                    <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>-->
<!--                                    <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>-->
<!--                                    <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜单</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->

    </section>


</aside>
