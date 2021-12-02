<?php

namespace Modules\Crm\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterCrmSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('crm::crms.title.crms'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('crm::accounts.title.accounts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.crm.account.create');
                    $item->route('admin.crm.account.index');
                    $item->authorize(
                        $this->auth->hasAccess('crm.accounts.index')
                    );
                });
                $item->item(trans('crm::contacts.title.contacts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.crm.contact.create');
                    $item->route('admin.crm.contact.index');
                    $item->authorize(
                        $this->auth->hasAccess('crm.contacts.index')
                    );
                });
                $item->item(trans('crm::leads.title.leads'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.crm.lead.create');
                    $item->route('admin.crm.lead.index');
                    $item->authorize(
                        $this->auth->hasAccess('crm.leads.index')
                    );
                });
                $item->item(trans('crm::activities.title.activities'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.crm.activity.create');
                    $item->route('admin.crm.activity.index');
                    $item->authorize(
                        $this->auth->hasAccess('crm.activities.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
