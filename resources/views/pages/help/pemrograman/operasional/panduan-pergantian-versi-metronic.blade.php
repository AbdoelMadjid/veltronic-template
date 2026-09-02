@extends('layouts.index')

@section('styles')
    @include('pages.help.pemrograman._schema-ui')
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Help
        @endslot
        @slot('li_2')
            {{ __('help.skema_pemrograman') }}
        @endslot
        @slot('li_3')
            {{ __('help.operasional') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <div class="schema-hero">
                    <span class="schema-pill">Theme Versioning</span>
                    <h2 class="fw-bold">{{ __('help.panduan_pergantian_versi_metronic') }}</h2>
                    <p class="schema-lead">
                        {{ __('help.pages.operasional.panduan-pergantian-versi-metronic.lead') }}
                    </p>
                </div>

                <div class="schema-grid">
                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_1') !!}</h4>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_11') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_12') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_13') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_14') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_15') !!}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_2') !!}</h4>
                            <pre class="schema-code"><code>app/Support/ThemeVersion.php
app/Support/ThemeAsset.php
app/Console/Commands/ThemeAssetsDiff.php
config/theme.php
tests/Feature/ThemeVersionRenderTest.php
tests/Unit/ThemeAssetTest.php</code></pre>
                            <div class="schema-note mt-4">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.note_1') !!}</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_3') !!}</h4>

                            <h5 class="fs-6 fw-bold mb-2"><code>app/Support/ThemeVersion.php</code></h5>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_16') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_17') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_18') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_19') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_20') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_21') !!}</li>
                            </ul>
                            <div class="schema-note mt-3">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.note_2') !!}</div>

                            <h5 class="fs-6 fw-bold mt-5 mb-2"><code>app/Support/ThemeAsset.php</code></h5>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_1') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_2') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_3') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_4') !!}</li>
                            </ul>
                            <pre class="schema-code mt-3">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.paragraph_1') !!}</pre>

                            <h5 class="fs-6 fw-bold mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_1') !!}</h5>
                            <pre class="schema-code">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.paragraph_2') !!}</pre>

                            <h5 class="fs-6 fw-bold mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_2') !!}</h5>
                            <pre class="schema-code"><code>php artisan theme:assets-diff {theme_version}
  [--source=...]
  [--base=assets]
  [--dry-run]
  [--keep-source]
  [--force]</code></pre>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_3') !!}</h5>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_5') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_6') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_7') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_8') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_9') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_10') !!}</li>
                            </ul>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_4') !!}</h5>
                            <div class="schema-flow">
                                <div class="schema-step">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.step_4') !!}</div>
                                <div class="schema-step">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.step_1') !!}</div>
                                <div class="schema-step">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.step_2') !!}</div>
                                <div class="schema-step">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.step_3') !!}</div>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_4') !!}</h4>
                            <h5 class="fs-6 fw-bold mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_5') !!}</h5>
                            <pre class="schema-code">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.paragraph_3') !!}</pre>

                            <h5 class="fs-6 fw-bold mt-5 mb-2">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.subheading_6') !!}</h5>
                            <pre class="schema-code"><code>- moved_unique
- renamed_css_js
- deleted_same
- deleted_diff_media
- skipped_exists
- errors</code></pre>
                            <div class="schema-note mt-4">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.note_3') !!}</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_5') !!}</h4>
                            <pre class="schema-code"><code>php artisan route:list --name=help.pemrograman
php artisan test tests/Feature/ThemeVersionRenderTest.php
php artisan test tests/Unit/ThemeAssetTest.php
php artisan optimize:clear</code></pre>
                            <div class="schema-warn mt-4">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.warn_1') !!}</div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_6') !!}</h4>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_22') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_23') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_24') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_25') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_26') !!}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_7') !!}</h4>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_27') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_28') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_29') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_30') !!}</li>
                            </ul>
                            <div class="schema-meta mt-4">
                                <span class="schema-chip">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.chip_1') !!}</span>
                                <span class="schema-chip">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.chip_2') !!}</span>
                                <span class="schema-chip">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.chip_3') !!}</span>
                                <span class="schema-chip">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.chip_4') !!}</span>
                            </div>
                        </div>
                    </div>

                    <div class="schema-col-6">
                        <div class="schema-card">
                            <h4>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.heading_8') !!}</h4>
                            <ul class="schema-list">
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_31') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_32') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_33') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_34') !!}</li>
                                <li>{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.item_35') !!}</li>
                            </ul>
                            <div class="schema-note mt-4">{!! __('help.pages.operasional.panduan-pergantian-versi-metronic.note_4') !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
