<?php

namespace App\Admin;

use Swoft\Admin\AbstractMenu;
use Swoft\Admin\Bean\Annotation\AdminMenu;
use Swoft\Admin\Menu\Models\AdminMenu as MenuEntity;
use Swoft\Db\Query;

/**
 * @AdminMenu()
 */
class Menu extends AbstractMenu
{
    /**
     * 主键名称
     *
     * @var string
     */
    public $keyName = 'id';

    /**
     * 父级id字段名称
     *
     * @var string
     */
    public $parentId = 'parent_id';

    /**
     * 标题字段名称
     *
     * @var string
     */
    public $title = 'title';

    /**
     * 优先级排序字段名称
     *
     * @var string
     */
    public $priority = 'priority';

    /**
     * 菜单url路径字段名称
     *
     * @var string
     */
    public $path = 'path';

    /**
     * 菜单图标字段名称
     *
     * @var string
     */
    public $icon = 'icon';

    /**
     * 返回菜单节点
     *
     * @return array
     */
    public function fetch(): array
    {
        return [
            [
                'id' => 1,
                'title' => '仪表盘',
                'priority' => 0,
                'path' => '/',
                'parent_id' => 0,
                'icon' => 'fa-bar-chart',
                'newpage' => false, // 是否打开新的窗口
                'useprefix' => true, // 是否使用路由前缀
            ],
            [
                'id' => 2,
                'title' => '系统设置',
                'priority' => 50,
                'path' => '',
                'parent_id' => 0,
                'icon' => 'fa-cogs',
                'newpage' => false, // 是否打开新的窗口
                'useprefix' => true, // 是否使用路由前缀
            ],
            [
                'id' => 3,
                'title' => '菜单管理',
                'priority' => 2,
                'path' => '/admin-menu',
                'parent_id' => 2,
                'icon' => '',
                'newpage' => false, // 是否打开新的窗口
                'useprefix' => false, // 是否使用路由前缀
            ],
            [
                'id' => 4,
                'title' => '代码生成器',
                'priority' => 10,
                'path' => '/admin-scaffold',
                'parent_id' => 2,
                'icon' => '',
                'newpage' => false, // 是否打开新的窗口
                'useprefix' => false, // 是否使用路由前缀
            ],
        ];
    }

}
