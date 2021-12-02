<?php

namespace Modules\Projects\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterProjectsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('projects::projects.title.projects'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('projects::projects.title.projects'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.projects.project.create');
                    $item->route('admin.projects.project.index');
                    $item->authorize(
                        $this->auth->hasAccess('projects.projects.index')
                    );
                });
                $item->item(trans('projects::objects.title.objects'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.projects.object.create');
                    $item->route('admin.projects.object.index');
                    $item->authorize(
                        $this->auth->hasAccess('projects.objects.index')
                    );
                });
                $item->item(trans('projects::activities.title.activities'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.projects.activity.create');
                    $item->route('admin.projects.activity.index');
                    $item->authorize(
                        $this->auth->hasAccess('projects.activities.index')
                    );
                });
                $item->item(trans('projects::tasks.title.tasks'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.projects.task.create');
                    $item->route('admin.projects.task.index');
                    $item->authorize(
                        $this->auth->hasAccess('projects.tasks.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
