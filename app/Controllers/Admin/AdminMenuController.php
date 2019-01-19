<?php

namespace App\Controllers\Admin;

use Swoft\Admin\Admin;
use Swoft\Admin\Form;
use Swoft\Admin\Grid;
use Swoft\Admin\Layout\Column;
use Swoft\Admin\Layout\Content;
use Swoft\Admin\Layout\Row;
use Swoft\App;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use App\Models\Entity\AdminMenu;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * 菜单编辑控制器示例
 * 需要新建菜单表：
 *
 * CREATE TABLE `admin_menu` (
 *     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 *     `title` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单标题',
 *     `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单图标',
 *     `path` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单链接',
 *     `priority` tinyint(4) NOT NULL DEFAULT '0' COMMENT '值越小排序越靠前',
 *     `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
 *     `useprefix` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '使用路由前缀',
 *     `newpage` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否强制跳转新的页面',
 *     `auth_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '菜单权限id(预留)',
 *     `created_at` timestamp NULL DEFAULT NULL,
 *     `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
 *     PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 *
 * @Controller("/admin-menu")
 */
class AdminMenuController
{
    /**
     * 设置路由前缀
     */
    public function setup()
    {
        Admin::setUrlPrefix('/');
    }
    
    /**
     * @RequestMapping("/admin-menu")
     */
    public function index(Content $content)
    {
        $this->setup();
        $header = t('Menu', 'admin-menu.labels');
        $content->breadcrumb($header);

        $url = Admin::url()->create();

        Admin::script(<<<EOF
$('#create-menu-btn').click(function () {
    layer.open({
        type: 2, 
        content: '$url',
        title: '$header',
        shadeClose: true,
        shade: false,
        area: ['50%', '80%'],
        end: function () {
            $('.grid-refresh').click()
        },
    });

});
EOF
        );

        return $content
            ->header($header)
            ->description(t('List', 'admin-menu.labels'))
            ->body($this->grid())
            ->response();
    }

    protected function grid()
    {
        $grid = new Grid();

        $grid->disableFilter();
        $grid->disableView();
        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->disableCreation();

        $grid->tools(function (Grid\Tools $tools) {
            $label = t('New', 'admin');
            $tools->append(
                "<div class='pull-right btn-group'>
                    <a id='create-menu-btn' class=\"btn btn-success\"> <i class='fa fa-save'></i> $label</a>
                </div>"
            );
        });

        $grid->id;
        $grid->icon->display(function ($value) {
            return "<i class='fa $value'></i>";
        });
        $grid->title->tree();
        $grid->path->editable();
        $grid->useprefix->switch();
        $grid->newpage->switch();
        $grid->priority->editable('select', range(0, 50));

        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('id');

        });

        return $grid;
    }

    /**
     * 创建表单
     *
     * @param mixed $id
     * @param bool $isUpdateOrDeleteRequest
     * @return Form
     */
    public function form($id = null, bool $isUpdateOrDeleteRequest = false)
    {
        $form = new Form();

        $form->disableViewButton();

        if ($id) {
            $form->display('id');
        }
        $form->text('title')->rules('required');
        $form->icon('icon');
        $form->text('path')
            ->prepend('<i class="fa fa-internet-explorer fa-fw"></i>')
            ->help('如果想跳转到第三方页面, 请填写完整url地址');

        $form->switch('useprefix')
            ->default(1);
        $form->switch('newpage');

        $form->select('priority')
            ->options(range(0, 50))
            ->help('可以通过此字段改变菜单排序, 值越小排序越靠前');

        // 获取所有菜单, 如果是修改或者是删除的请求就不需要查处菜单数据
        $menus = $isUpdateOrDeleteRequest ? [] : $this->getAllMenuExceptSelf($id);

        $form->tree('parent_id')->options($menus);

        $form->hidden('updated_at');
        if ($id) {
            $form->display('created_at');
            $form->display('updated_at');
        } else {
            // 新增记录的时候防止字段被过滤
            $form->hidden('created_at');
        }

        return $form;
    }

    /**
     * @param $id
     * @return array
     */
    protected function getAllMenuExceptSelf($id)
    {
        $q = AdminMenu::query();

        $id && $q->where('id', $id, '!=');

        $menus = $q->get(['id', 'title', 'parent_id'])->getResult();

        return $menus ? $menus->toArray() : [];
    }


    /**
     * 新增页
     *
     * @RequestMapping(route="create", method=RequestMethod::GET)
     *
     * @param Content $content
     * @return mixed
     */
    public function create(Content $content)
    {
        $this->setup();
        $form = $this->form();

        $form->disableViewCheck();
        $form->disableEditingCheck();
        $form->disableListButton();

        return $content
            ->body($form)
            ->simple()
            ->response();
    }

    /**
     * 编辑页
     *
     * @RequestMapping(route="{id}", method=RequestMethod::GET)
     *
     * @param mixed $id
     * @param Content $content
     * @return mixed
     */
    public function edit($id, Content $content)
    {
        $this->setup();
        $header = translate_label('Menu');
        $current = translate_label('Edit');
        $content->breadcrumb($header, Admin::url()->list());
        $content->breadcrumb($current);

        $form = $this->form($id);
        // 使用row布局风格
        $form->style(Form::STYLE_ROW);

        return $content
            ->header($header)
            ->description($current)
            ->body($form->edit($id))
            ->response();
    }

    /**
     * 修改记录(包括修改单个字段)
     *
     * @RequestMapping(route="{id}", method=RequestMethod::POST)
     *
     * @param mixed $id
     * @return mixed
     */
    public function update($id)
    {
        $this->setup();
        return $this->form($id, true)
            ->saving(function (Form $form) {
                $date = date('Y-m-d H:i:s');

                // 由于swoft实体没有自动更新created_at字段的功能,所以新增或编辑时需要手动加
                $form->input('updated_at', $date);
            })
            ->update($id)
            ->done();
    }

    /**
     * 新增记录
     *
     * @RequestMapping(route="create", method=RequestMethod::POST)
     *
     * @return mixed
     */
    public function insert()
    {
        $this->setup();
        return $this->form()
            ->saving(function (Form $form) {
                $date = date('Y-m-d H:i:s');

                // 由于swoft实体没有自动更新created_at字段的功能,所以新增或编辑时需要手动加
                $form->input('created_at', $date);
                $form->input('updated_at', $date);
            })
            ->insert()
            ->done(Admin::url()->create());
    }

    /**
     * 删除(批量)记录
     *
     * @RequestMapping(route="{id}", method=RequestMethod::DELETE)
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->setup();
        if ($this->form($id, true)->destroy($id)) {
            $data = [
                'status'  => true,
                'message' => t('Delete succeeded!', 'admin'),
            ];
        } else {
            $data = [
                'status'  => false,
                'message' => t('Delete failed!', 'admin'),
            ];
        }

        return response()->json($data);
    }

}
