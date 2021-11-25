<?php

namespace Modules\History\Events\Handlers;

use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterHistorySidebar extends AbstractAdminSidebar
{
    /**
     * Method used to define your sidebar menu groups and items
     *
     * @param \Maatwebsite\Sidebar\Menu $menu
     *
     * @return \Maatwebsite\Sidebar\Menu
     */
    public function extendWith(\Maatwebsite\Sidebar\Menu $menu)
    {
        return $menu;
    }
}
