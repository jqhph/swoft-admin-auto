<?php

namespace App\Listener;

use Swoft\Admin\Bean\Annotation\AdminRepositoryListener;
use Swoft\Admin\Form;
use Swoft\Admin\Repository\RepositoryEventInterface;
use App\Admin\Repositories\AdminMenu;

/**
 * 菜单数据操作钩子事件监听示例
 *
 * @AdminRepositoryListener(AdminMenu::class)
 */
class AdminMenuListener implements RepositoryEventInterface
{
    /**
     * @param Form $form
     */
    public function beforeInsert(Form $form)
    {
        admin_debug('新增菜单');
    }

    /**
     * @param Form $form
     * @param mixed $result 新增数据返回结果
     */
    public function afterInsert(Form $form, $result)
    {
        admin_debug('新增菜单结果：'.$result);
    }

    /**
     * @param Form $form
     */
    public function beforeUpdate(Form $form)
    {
        admin_debug('修改菜单');
    }

    /**
     * @param Form $form
     * @param mixed $result 编辑数据返回结果
     */
    public function afterUpdate(Form $form, $result)
    {
        admin_debug('修改菜单结果：'.$result);
    }

    /**
     * @param Form $form
     */
    public function beforeDelete(Form $form)
    {
        admin_debug('删除菜单');
    }

    /**
     * @param Form $form
     * @param $result
     */
    public function afterDelete(Form $form, $result)
    {
        admin_debug('删除菜单结果：'.$result);
    }
}
