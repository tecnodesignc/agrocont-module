<?php

namespace Modules\Agrocont\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterAgrocontSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('agrocont::agroconts.title.agroconts'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('agrocont::lands.title.lands'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.agrocont.lands.create');
                    $item->route('admin.agrocont.lands.index');
                    $item->authorize(
                        $this->auth->hasAccess('agrocont.lands.index')
                    );
                });
                $item->item(trans('agrocont::lots.title.lots'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.agrocont.lots.create');
                    $item->route('admin.agrocont.lots.index');
                    $item->authorize(
                        $this->auth->hasAccess('agrocont.lots.index')
                    );
                });
                $item->item(trans('agrocont::crops.title.crops'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.agrocont.crops.create');
                    $item->route('admin.agrocont.crops.index');
                    $item->authorize(
                        $this->auth->hasAccess('agrocont.crops.index')
                    );
                });
                $item->item(trans('agrocont::activities.title.activities'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.agrocont.activities.create');
                    $item->route('admin.agrocont.activities.index');
                    $item->authorize(
                        $this->auth->hasAccess('agrocont.activities.index')
                    );
                });
              
// append






            });
        });

        return $menu;
    }
}
