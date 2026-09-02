@php($vars = $vars ?? [])
<!--begin::Engage widget 15-->
<div class="{{ $vars['card_class'] ?? 'card h-md-100' }}" dir="{{ $vars['dir'] ?? 'ltr' }}">
    <!--begin::Body-->
    <div class="card-body d-flex flex-column flex-center">
        <!--begin::Heading-->
        <div class="mb-2">
            <!--begin::Title-->
            <h1 class="{{ $vars['title_class'] ?? 'fw-semibold text-gray-800 text-center lh-lg' }}">{{ $vars['title_line_1'] ?? 'Have you tried' }}
                <br />{{ $vars['title_line_2'] ?? 'new' }}
                <span class="{{ $vars['title_highlight_class'] ?? 'fw-bolder' }}">{{ $vars['title_highlight'] ?? 'Mobile Application ?' }}</span>
            </h1>
            <!--end::Title-->
            <!--begin::Illustration-->
            <div class="py-10 text-center">
                @if ($vars['single_image'] ?? false)
                    <img src="{{ $vars['single_image_src'] ?? \App\Support\ThemeAsset::url('media/svg/illustrations/easy/9.svg', $theme_asset_pack ?? null) }}"
                        class="{{ $vars['single_image_class'] ?? 'w-200px' }}" alt="" />
                @else
                    <img src="{{ $vars['image_light_src'] ?? \App\Support\ThemeAsset::url('media/svg/illustrations/easy/1.svg', $theme_asset_pack ?? null) }}"
                        class="{{ $vars['image_light_class'] ?? 'theme-light-show w-200px' }}" alt="" />
                    <img src="{{ $vars['image_dark_src'] ?? \App\Support\ThemeAsset::url('media/svg/illustrations/easy/1-dark.svg', $theme_asset_pack ?? null) }}"
                        class="{{ $vars['image_dark_class'] ?? 'theme-dark-show w-200px' }}" alt="" />
                @endif
            </div>
            <!--end::Illustration-->
        </div>
        <!--end::Heading-->
        <!--begin::Links-->
        <div class="text-center mb-1">
            <!--begin::Link-->
            <a class="{{ $vars['action_class'] ?? 'btn btn-sm btn-dark me-2' }}"
                data-bs-target="{{ $vars['action_target'] ?? '#kt_modal_create_app' }}"
                data-bs-toggle="{{ $vars['action_toggle'] ?? 'modal' }}">{{ $vars['action_text'] ?? 'Try now' }}</a>
            <!--end::Link-->
        </div>
        <!--end::Links-->
    </div>
    <!--end::Body-->
</div>
<!--end::Engage widget 15-->
