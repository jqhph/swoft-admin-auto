<?php

namespace App\Admin\Repositories;

use Swoft\Admin\Bean\Annotation\AdminRepository;
use Swoft\Admin\Repository\AbstractRepository;
use App\Models\Entity\AdminMenu as AdminMenuEntity;
use App\Controllers\Admin\AdminMenuController;

/**
 * 菜单数据操作接口示例
 *
 * @AdminRepository(AdminMenuController::class)
 */
class AdminMenu extends AbstractRepository
{
    /**
     * 实体类类名
     *
     * @var string
     */
    protected $entityClass = AdminMenuEntity::class;
}
