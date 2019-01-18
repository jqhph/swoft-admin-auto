<?php

namespace App\Controllers\Admin;

use Swoft\Admin\Admin;
use Swoft\Admin\Layout\Column;
use Swoft\Admin\Layout\Row;
use Swoft\Admin\Widgets\Tab;
use Swoft\Admin\Widgets\Table;
use Swoft\App;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Support\SessionHelper;

/**
 * 后台首页控制器示例
 *
 * @Controller()
 */
class IndexController
{
    /**
     * @RequestMapping("/")
     */
    public function index()
    {
        return blade('admin::login', [
            'errors' => get_flash_errors(),
        ])->toResponse();
    }

    /**
     * 首页
     *
     * @RequestMapping("/admin")
     */
    public function admin()
    {
        $content = Admin::content();

        $content->header(t('Dashboard', 'admin'));
        $content->description(t('Description...', 'admin'));

        $content->row(blade('admin::dashboard.title'));

        $content->row(function (Row $row) {
            $row->column(12, function (Column $column) {
                $tab = new Tab();

                $tab->add('环境和依赖', $this->getEnv()->render().$this->getDependencies()->render());
                $tab->add('扩展', $this->getExt());

                $column->append($tab);
            });

        });

        return $content->response();
    }

    protected function getExt()
    {
        $ext = [];

        return '<div style="margin:5px 0 0 10px;"><span class="help-block" style="margin-bottom:0"><i class="fa fa-info-circle"></i>&nbsp;什么都没有~</span></div>';
    }

    protected function getEnv()
    {
        $env = [
            'PHP' => PHP_VERSION,
            'Swoole' => SWOOLE_VERSION,
            'Swoft' => App::version(),
            'Locale' => current_lang(),
            'Session'  => SessionHelper::wrap() ? 'on' : 'off',
        ];

        foreach ($env as $k => &$version) {
            $version = "<span class='label label-primary'>$version</span>";
        }

        return (new Table(['环境'], $env))->class('table table-striped');
    }

    protected function getDependencies()
    {
        $dependencies = [
            'php' => '>=7.0',
            'ext-swoole' => '>=2.1',
            'lldca/swoft-blade' => '0.1.0',
            'lldca/swoft-migration' => '0.1.0',
            'league/flysystem'  => '^1.1',
            'symfony/debug' => '^4.1',
            'symfony/var-dumper' => '^4.1'
        ];


        foreach ($dependencies as $k => &$version) {
            $version = "<span class='label label-primary'>$version</span>";
        }


        return (new Table(['依赖'], $dependencies))->class('table table-striped');
    }



}
