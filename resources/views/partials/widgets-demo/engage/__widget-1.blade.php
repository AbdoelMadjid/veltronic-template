@php($vars = $vars ?? [])
@php($layout = $vars['layout'] ?? 'city')
<!--begin::Engage widget 1-->
@if ($layout === 'invoice')
    <div class="{{ $vars['card_class'] ?? 'card h-md-100' }}" dir="{{ $vars['dir'] ?? 'ltr' }}">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column flex-center">
            <!--begin::Heading-->
            <div class="mb-2">
                <!--begin::Title-->
                <h1 class="{{ $vars['title_class'] ?? 'fw-semibold text-gray-800 text-center lh-lg' }}">{{ $vars['title_line_1'] ?? 'Try out our' }}
                    <br />{{ $vars['title_line_2'] ?? 'new' }}
                    <span class="{{ $vars['title_highlight_class'] ?? 'fw-bolder' }}">{{ $vars['title_highlight'] ?? 'Invoice Manager' }}</span>
                </h1>
                <!--end::Title-->
                <!--begin::Illustration-->
                <div class="py-10 text-center">
                    <img src="{{ $vars['image_light_src'] ?? \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2.svg', $theme_asset_pack ?? null) }}"
                        class="{{ $vars['image_light_class'] ?? 'theme-light-show w-200px' }}" alt="" />
                    <img src="{{ $vars['image_dark_src'] ?? \App\Support\ThemeAsset::url('media/svg/illustrations/easy/2-dark.svg', $theme_asset_pack ?? null) }}"
                        class="{{ $vars['image_dark_class'] ?? 'theme-dark-show w-200px' }}" alt="" />
                </div>
                <!--end::Illustration-->
            </div>
            <!--end::Heading-->
            <!--begin::Links-->
            <div class="text-center mb-1">
                <!--begin::Link-->
                <a class="{{ $vars['primary_btn_class'] ?? 'btn btn-sm btn-primary me-2' }}"
                    @if (isset($vars['primary_btn_href'])) href="{{ $vars['primary_btn_href'] }}" @endif
                    @if (array_key_exists('primary_btn_toggle', $vars))
                        data-bs-toggle="{{ $vars['primary_btn_toggle'] }}"
                    @elseif (!isset($vars['primary_btn_href']))
                        data-bs-toggle="modal"
                    @endif
                    @if (array_key_exists('primary_btn_target', $vars))
                        data-bs-target="{{ $vars['primary_btn_target'] }}"
                    @elseif (!isset($vars['primary_btn_href']))
                        data-bs-target="#kt_modal_new_address"
                    @endif>{{ $vars['primary_btn_text'] ?? 'Try Now' }}</a>
                <!--end::Link-->
                <!--begin::Link-->
                <a class="{{ $vars['secondary_btn_class'] ?? 'btn btn-sm btn-light' }}" href="{{ $vars['secondary_btn_href'] ?? url('apps/user-management/users/view') }}">{{ $vars['secondary_btn_text'] ?? 'Learn More' }}</a>
                <!--end::Link-->
            </div>
            <!--end::Links-->
        </div>
        <!--end::Body-->
    </div>
@else
    <div class="{{ $vars['card_class'] ?? 'card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px bg-primary mb-5 mb-xl-8' }}"
        style="background-position: {{ $vars['background_position'] ?? '100% 50px' }};background-size: {{ $vars['background_size'] ?? '500px auto' }};background-image:url('{{ $vars['background_image'] ?? \App\Support\ThemeAsset::url('media/misc/city.png', $theme_asset_pack ?? null) }}')"
        dir="ltr">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column justify-content-center ps-lg-12">
            <!--begin::Title-->
            <h3 class="{{ $vars['title_class'] ?? 'text-gray-900 fs-2qx fw-bold mb-7' }}">{{ $vars['title_line_1'] ?? 'We are working' }}
                <br />{{ $vars['title_line_2'] ?? 'to boost lovely mood' }}
            </h3>
            <!--end::Title-->
            <!--begin::Action-->
            <div class="m-0">
                <a href="{{ $vars['action_href'] ?? 'javascript:void(0)' }}" class="{{ $vars['action_class'] ?? 'btn btn-dark fw-semibold px-6 py-3' }}"
                    data-bs-toggle="{{ $vars['action_modal_toggle'] ?? 'modal' }}" data-bs-target="{{ $vars['action_modal_target'] ?? '#kt_modal_create_app' }}">{{ $vars['action_text'] ?? 'Create a Store' }}</a>
            </div>
            <!--begin::Action-->
        </div>
        <!--end::Body-->
    </div>
@endif
<!--end::Engage widget 1-->
