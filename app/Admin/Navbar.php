<?php

namespace App\Admin;

use Swoft\Admin\AbstractNavbar;
use Swoft\Admin\Bean\Annotation\AdminNavbar;
use Swoft\Admin\Widgets\Navbar as WidgetNavbar;

/**
 * 自定义导航栏内容示例
 *
 * @AdminNavbar()
 */
class Navbar extends AbstractNavbar
{
    /**
     * 自定义顶部导航栏内容
     *
     * @param WidgetNavbar $navbar
     * @return void
     */
    public function build(WidgetNavbar $navbar)
    {
        $navbar->left(function () {
            return <<<EOF
<style>
.search-form {
    width: 250px;
    margin: 10px 0 0 20px;
    border-radius: 3px;
    float: left;
}
.search-form input[type="text"] {
    color: #666;
    border: 0;
    background:#f8f8f8;
}
.search-form .btn {
    color: #999;
    background-color: #f8f8f8;
    border: 0;
}
</style>
<form action="" method="get" class="search-form" pjax-container="">
    <div class="input-group input-group-sm ">
        <input type="text" name="global" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
    </div>
</form>
EOF;

        });

        $navbar->right(blade('admin.navbar-right'));

        $navbar->right(function () {
            return <<<EOF
<li>
    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>
EOF;
        });
    }
}
