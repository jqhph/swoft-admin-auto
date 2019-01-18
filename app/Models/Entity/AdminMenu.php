<?php
namespace App\Models\Entity;

use Swoft\Db\Model;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Types;

/**
 * @Entity()
 * @Table(name="admin_menu")
 * @uses      AdminMenu
 */
class AdminMenu extends Model
{
    /**
     * @var int $id
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $title 菜单标题
     * @Column(name="title", type="string", length=255, default="")
     */
    private $title;

    /**
     * @var string $icon 菜单图标
     * @Column(name="icon", type="string", length=255, default="")
     */
    private $icon;

    /**
     * @var string $path 菜单链接
     * @Column(name="path", type="string", length=255, default="")
     */
    private $path;

    /**
     * @var int $priority 值越小排序越靠前
     * @Column(name="priority", type="tinyint", default=0)
     */
    private $priority;

    /**
     * @var int $parentId 父级id
     * @Column(name="parent_id", type="integer", default=0)
     */
    private $parent_id;

    /**
     * @var int $useprefix 使用路由前缀
     * @Column(name="useprefix", type="tinyint", default=1)
     */
    private $useprefix;

    /**
     * @var int $authId 菜单权限id(预留)
     * @Column(name="auth_id", type="integer", default=0)
     */
    private $auth_id;

    /**
     * @var int $newpage 是否强制跳转新的页面
     * @Column(name="newpage", type="tinyint", default=0)
     */
    private $newpage;

    /**
     * @var string $createdAt
     * @Column(name="created_at", type="timestamp")
     */
    private $created_at;

    /**
     * @var string $updatedAt 更新时间
     * @Column(name="updated_at", type="timestamp")
     */
    private $updated_at;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 菜单标题
     * @param string $value
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;

        return $this;
    }

    /**
     * 菜单图标
     * @param string $value
     * @return $this
     */
    public function setIcon(string $value): self
    {
        $this->icon = $value;

        return $this;
    }

    /**
     * 菜单链接
     * @param string $value
     * @return $this
     */
    public function setPath(string $value): self
    {
        $this->path = $value;

        return $this;
    }

    /**
     * 值越小排序越靠前
     * @param int $value
     * @return $this
     */
    public function setPriority(int $value): self
    {
        $this->priority = $value;

        return $this;
    }

    /**
     * 父级id
     * @param int $value
     * @return $this
     */
    public function setParentId(int $value): self
    {
        $this->parent_id = $value;

        return $this;
    }

    /**
     * 使用路由前缀
     * @param int $value
     * @return $this
     */
    public function setUseprefix(int $value): self
    {
        $this->useprefix = $value;

        return $this;
    }

    /**
     * 是否强制跳转新的页面
     * @param int $value
     * @return AdminMenu
     */
    public function setNewpage(int $value): self
    {
        $this->newpage = $value;

        return $this;
    }

    /**
     * 菜单权限id(预留)
     * @param int $value
     * @return $this
     */
    public function setAuthId(int $value): self
    {
        $this->auth_id = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCreatedAt(string $value): self
    {
        $this->created_at = $value;

        return $this;
    }

    /**
     * 更新时间
     * @param string $value
     * @return $this
     */
    public function setUpdatedAt(string $value): self
    {
        $this->updated_at = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 菜单标题
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 菜单图标
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * 菜单链接
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * 值越小排序越靠前
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * 父级id
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * 使用路由前缀
     * @return int
     */
    public function getUseprefix()
    {
        return $this->useprefix;
    }

    /**
     * 是否跳转新的页面
     * @return int
     */
    public function getNewpage()
    {
        return $this->newpage;
    }

    /**
     * 菜单权限id(预留)
     * @return int
     */
    public function getAuthId()
    {
        return $this->auth_id;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * 更新时间
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

}
