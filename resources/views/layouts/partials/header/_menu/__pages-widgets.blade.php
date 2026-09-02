@php
    $widgetsPrimaryMenus = [
        ['route' => 'pages.widgets.calendar', 'title' => __('menu.calendar')],
        ['route' => 'pages.widgets.cards', 'title' => __('menu.cards')],
        ['route' => 'pages.widgets.charts', 'title' => __('menu.charts')],
        ['route' => 'pages.widgets.engage', 'title' => __('menu.engage')],
        ['route' => 'pages.widgets.feeds', 'title' => __('menu.feeds')],
        ['route' => 'pages.widgets.forms', 'title' => __('menu.forms')],
        ['route' => 'pages.widgets.general', 'title' => __('menu.general')],
        ['route' => 'pages.widgets.lists', 'title' => __('menu.lists')],
    ];

    $widgetsCollapsedMenus = [
        ['route' => 'pages.widgets.maps', 'title' => __('menu.maps')],
        ['route' => 'pages.widgets.misc', 'title' => __('menu.misc')],
        ['route' => 'pages.widgets.mixed', 'title' => __('menu.mixed')],
        ['route' => 'pages.widgets.player', 'title' => __('menu.player')],
        ['route' => 'pages.widgets.sliders', 'title' => __('menu.sliders')],
        ['route' => 'pages.widgets.social', 'title' => __('menu.social')],
        ['route' => 'pages.widgets.statistics', 'title' => __('menu.statistics')],
        ['route' => 'pages.widgets.tables', 'title' => __('menu.tables')],
        ['route' => 'pages.widgets.tiles', 'title' => __('menu.tiles')],
        ['route' => 'pages.widgets.timeline', 'title' => __('menu.timeline')],
        ['route' => 'pages.widgets.video', 'title' => __('menu.video')],
    ];
    $widgetsMenus = array_merge($widgetsPrimaryMenus, $widgetsCollapsedMenus);
    $widgetsMenusChunks = array_chunk($widgetsMenus, (int) ceil(count($widgetsMenus) / 3));
@endphp

<!--begin:Row-->
<div class="row">
    <div class="col-lg-5 mb-6 mb-lg-0">
        <div class="row">
            @foreach ($widgetsMenusChunks as $menusChunk)
                <div class="col-lg-4 mb-6 mb-lg-0">
                    @foreach ($menusChunk as $menu)
                        <div class="menu-item p-0 m-0">
                            <a href="{{ route($menu['route']) }}"
                                class="menu-link {{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                                <span class="menu-title">{{ $menu['title'] }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-7 d-flex justify-content-end">
        <img src="{{ \App\Support\ThemeAsset::url('media/stock/900x600/44.jpg', $theme_asset_pack ?? null) }}" class="rounded w-100" style="max-width: 420px;" alt="" />
    </div>
</div>
<!--end:Row-->
