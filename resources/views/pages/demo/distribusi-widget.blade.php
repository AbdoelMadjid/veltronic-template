{{-- Auto-generated: widget usage distribution grouped by category (box layout) --}}
@extends('layouts.index')

@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}"
        rel="stylesheet" type="text/css" />
    <style>
        .widget-distribution-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 1200px) {
            .widget-distribution-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .widget-distribution-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }

        .widget-category-box {
            border: 1px solid var(--bs-gray-300);
            border-radius: 0.85rem;
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        .widget-category-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--bs-gray-200);
            background-color: #f4f8ff;
        }

        .widget-category-title {
            margin: 0;
            font-size: 1.08rem;
            font-weight: 700;
            color: var(--bs-dark);
        }

        .widget-category-count {
            white-space: nowrap;
        }

        .widget-category-body {
            max-height: 280px;
            overflow: auto;
            padding: 0.8rem 1rem 1rem;
        }

        .widget-row-box {
            padding: 0.9rem 0.25rem;
            border-bottom: 1px dashed var(--bs-gray-300);
        }

        .widget-row-box:last-child {
            border-bottom: 0;
        }

        .widget-row-index {
            display: inline-block;
            min-width: 1.5rem;
            text-align: right;
        }

        .widget-row-indent {
            margin-left: 2rem;
        }
    </style>
    <!--end::Vendor Stylesheets-->
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('li_2')
            Demo
        @endslot
        @slot('action')
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_project">Manage Bids</a>
                <a href="javascript:void(0)" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_campaign">Start Auction</a>
            </div>
        @endslot
    @endcomponent
@endsection

@php
    $demoDir = resource_path('views/pages/demo');
    $demoFiles = \Illuminate\Support\Facades\File::allFiles($demoDir);

    $widgetsByCategory = [];
    $flexibleWidgetsMap = [];

    foreach ($demoFiles as $demoFile) {
        $relativePath = str_replace('\\', '/', $demoFile->getRelativePathname());

        if (!preg_match('/^(sepuluh[a-z]+\/demo\d+)\.blade\.php$/', $relativePath, $demoMatch)) {
            continue;
        }

        $demoKey = $demoMatch[1];
        $fileContent = \Illuminate\Support\Facades\File::get($demoFile->getPathname());

        preg_match_all("/@include\(\s*'partials\.widgets-demo\.([^']+)'(?:\s*,|\s*\))/m", $fileContent, $matchesSingle);
        preg_match_all('/@include\(\s*"partials\.widgets-demo\.([^"]+)"(?:\s*,|\s*\))/m', $fileContent, $matchesDouble);

        $widgets = array_values(array_unique(array_merge($matchesSingle[1] ?? [], $matchesDouble[1] ?? [])));

        foreach ($widgets as $widgetName) {
            $parts = explode('.', $widgetName, 2);
            $category = $parts[0] ?? 'lainnya';

            if (!isset($widgetsByCategory[$category])) {
                $widgetsByCategory[$category] = [];
            }
            if (!isset($widgetsByCategory[$category][$widgetName])) {
                $widgetsByCategory[$category][$widgetName] = [];
            }
            if (!in_array($demoKey, $widgetsByCategory[$category][$widgetName], true)) {
                $widgetsByCategory[$category][$widgetName][] = $demoKey;
            }
        }

        preg_match_all("/@include\(\s*'partials\.widgets-demo\.([^']+)'\s*,/m", $fileContent, $flexMatchesSingle);
        preg_match_all('/@include\(\s*"partials\.widgets-demo\.([^"]+)"\s*,/m', $fileContent, $flexMatchesDouble);

        foreach (array_merge($flexMatchesSingle[1] ?? [], $flexMatchesDouble[1] ?? []) as $flexWidget) {
            $flexibleWidgetsMap[$flexWidget] = true;
        }
    }

    ksort($widgetsByCategory, SORT_NATURAL | SORT_FLAG_CASE);
    foreach ($widgetsByCategory as &$widgets) {
        ksort($widgets, SORT_NATURAL | SORT_FLAG_CASE);
        foreach ($widgets as &$demos) {
            sort($demos, SORT_NATURAL | SORT_FLAG_CASE);
        }
        unset($demos);
    }
    unset($widgets);

    $flexibleWidgets = array_keys($flexibleWidgetsMap);
    sort($flexibleWidgets, SORT_NATURAL | SORT_FLAG_CASE);

    $topWidgetsUsed = [];
    foreach ($widgetsByCategory as $categoryWidgets) {
        foreach ($categoryWidgets as $widgetName => $demos) {
            $topWidgetsUsed[] = [
                'name' => $widgetName,
                'count' => count($demos),
                'demos' => $demos,
            ];
        }
    }

    usort($topWidgetsUsed, function ($a, $b) {
        if ($a['count'] === $b['count']) {
            return strnatcasecmp($a['name'], $b['name']);
        }
        return $b['count'] <=> $a['count'];
    });

    $topWidgetsUsed = array_slice($topWidgetsUsed, 0, 10);
@endphp

@section('content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="d-flex flex-column">
                <h3 class="card-title mb-1">Distribusi Widget per Kategori</h3>
                <span class="text-muted fs-7">
                    Klik nama widget untuk preview. Klik badge demo untuk membuka halaman demo terkait.
                </span>
            </div>
        </div>
        <div class="card-body py-4">
            <div id="widget_distribution_boxes" class="widget-distribution-grid">
                @foreach ($widgetsByCategory as $category => $widgets)
                    <div class="widget-category-box">
                        <div class="widget-category-head">
                            <h5 class="widget-category-title">{{ $category }}</h5>
                            <span class="badge badge-light-primary fw-semibold widget-category-count">
                                {{ count($widgets) }} widget
                            </span>
                        </div>
                        <div class="widget-category-body">
                            @foreach ($widgets as $widgetName => $demos)
                                <div class="widget-row-box">
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="text-muted fw-bold fs-8 widget-row-index">{{ $loop->iteration }}.</span>
                                        <a href="#"
                                            class="widget-preview-trigger text-gray-800 text-hover-primary fw-semibold"
                                            data-widget="{{ $widgetName }}">
                                            <code>{{ $widgetName }}</code>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mt-3 widget-demo-links widget-row-indent">
                                        @foreach ($demos as $demo)
                                            <a href="{{ url('demo/' . $demo) }}" target="_blank" rel="noopener noreferrer"
                                                class="badge badge-light-primary fw-semibold fs-8 px-3 py-2 text-hover-primary">
                                                {{ \Illuminate\Support\Str::afterLast($demo, '/') }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($category === 'video')
                        <div class="widget-category-box">
                            <div class="widget-category-head">
                                <h5 class="widget-category-title">Top 10 Widget Digunakan</h5>
                                <span class="badge badge-light-success fw-semibold widget-category-count">
                                    {{ count($topWidgetsUsed) }} widget
                                </span>
                            </div>
                            <div class="widget-category-body">
                                @foreach ($topWidgetsUsed as $topWidget)
                                    <div class="widget-row-box">
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <a href="#"
                                                class="widget-preview-trigger text-gray-800 text-hover-primary fw-semibold"
                                                data-widget="{{ $topWidget['name'] }}">
                                                <code>{{ $topWidget['name'] }}</code>
                                            </a>
                                            <span class="badge badge-light-info fw-semibold">
                                                {{ $topWidget['count'] }} demo
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 mt-3 widget-demo-links">
                                            @foreach ($topWidget['demos'] as $demo)
                                                <a href="{{ url('demo/' . $demo) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="badge badge-light-dark fw-semibold fs-8 px-3 py-2 text-hover-primary">
                                                    {{ \Illuminate\Support\Str::afterLast($demo, '/') }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    @include('partials.widgets-demo.distribusi-demo')

    <div class="modal fade" id="widgetPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 900px; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-4">Preview Widget</h2>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-light-primary d-none" id="widgetCopyCodeBtn">
                            Copy Script
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body" id="widgetPreviewBody">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="widget-preview-tab" data-bs-toggle="tab"
                                data-bs-target="#widget-preview-pane" type="button" role="tab">Preview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="widget-code-tab" data-bs-toggle="tab"
                                data-bs-target="#widget-code-pane" type="button" role="tab">Code</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="widget-preview-pane" role="tabpanel">
                            <div id="widgetPreviewPaneContent" class="d-flex align-items-center gap-2 text-muted">
                                <span class="spinner-border spinner-border-sm"></span>
                                <span>Memuat widget...</span>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="widget-code-pane" role="tabpanel">
                            <pre class="bg-light rounded p-4 mb-0" style="max-height: 70vh; overflow: auto;"><code id="widgetCodeBlock">Memuat source code...</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/fullcalendar/fullcalendar.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}">
    </script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/apps/chat/chat.js', $theme_asset_pack ?? null) }}"></script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-campaign.js', $theme_asset_pack ?? null) }}">
    </script>
    <script
        src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}">
    </script>
    <script>
        (function() {
            const markFlexibleWidgets = () => {
                const fleksibilitasWidgets = new Set(@json($flexibleWidgets));
                document.querySelectorAll('.widget-preview-trigger[data-widget]').forEach((el) => {
                    const widgetName = el.getAttribute('data-widget');
                    if (!widgetName || !fleksibilitasWidgets.has(widgetName)) return;
                    if (el.dataset.flexibilityMarked === '1') return;

                    const mark = document.createElement('span');
                    mark.className = 'badge badge-light-info ms-2 align-middle';
                    mark.textContent = 'Var Fleksibilitas';
                    mark.style.fontSize = '10px';
                    mark.style.fontWeight = '700';
                    mark.style.verticalAlign = 'middle';

                    const markWrapper = document.createElement('div');
                    markWrapper.className = 'mt-1';
                    markWrapper.appendChild(mark);

                    const rowBox = el.closest('.widget-row-box');
                    const demosContainer = rowBox?.querySelector('.widget-demo-links');
                    if (demosContainer?.classList.contains('widget-row-indent')) {
                        markWrapper.classList.add('widget-row-indent');
                    }

                    if (rowBox && demosContainer) {
                        rowBox.insertBefore(markWrapper, demosContainer);
                    } else {
                        el.insertAdjacentElement('afterend', markWrapper);
                    }

                    el.dataset.flexibilityMarked = '1';
                });
            };

            markFlexibleWidgets();

            const modalEl = document.getElementById('widgetPreviewModal');
            const bodyEl = document.getElementById('widgetPreviewBody');
            if (!modalEl || !bodyEl) return;

            const dialogEl = modalEl.querySelector('.modal-dialog');
            const titleEl = modalEl.querySelector('.modal-title');
            const previewPaneContentEl = document.getElementById('widgetPreviewPaneContent');
            const codeBlockEl = document.getElementById('widgetCodeBlock');
            const copyCodeBtnEl = document.getElementById('widgetCopyCodeBtn');
            const previewTabBtnEl = document.getElementById('widget-preview-tab');
            const codeTabBtnEl = document.getElementById('widget-code-tab');
            const previewModal = new bootstrap.Modal(modalEl);
            const previewTab = previewTabBtnEl ? new bootstrap.Tab(previewTabBtnEl) : null;
            let currentWidget = '';
            let currentCodeText = '';
            let copyButtonTimer = null;

            const setLoading = () => {
                previewPaneContentEl.className = 'd-flex align-items-center gap-2 text-muted';
                previewPaneContentEl.innerHTML =
                    '<div class="d-flex align-items-center gap-2 text-muted"><span class="spinner-border spinner-border-sm"></span><span>Memuat widget...</span></div>';
                codeBlockEl.textContent = 'Memuat source code...';
                if (copyCodeBtnEl) copyCodeBtnEl.textContent = 'Copy Script';
            };

            const setError = (message) => {
                previewPaneContentEl.className = '';
                previewPaneContentEl.innerHTML = '<div class="alert alert-warning mb-0">' + message + '</div>';
                dialogEl.style.maxWidth = '900px';
            };

            const resizeDialogToContent = (contentWidth = 900) => {
                const viewportMax = Math.floor(window.innerWidth * 0.95);
                const targetWidth = Math.max(560, Math.min(viewportMax, contentWidth + 64));
                dialogEl.style.maxWidth = targetWidth + 'px';
            };

            const setCopyButtonVisible = (visible) => {
                if (!copyCodeBtnEl) return;
                copyCodeBtnEl.classList.toggle('d-none', !visible);
            };

            const updateCopyButtonState = (text, className) => {
                if (!copyCodeBtnEl) return;
                copyCodeBtnEl.textContent = text;
                copyCodeBtnEl.className = `btn btn-sm ${className}`;

                if (copyButtonTimer) {
                    clearTimeout(copyButtonTimer);
                    copyButtonTimer = null;
                }

                if (text !== 'Copy Script') {
                    copyButtonTimer = setTimeout(() => {
                        copyCodeBtnEl.textContent = 'Copy Script';
                        copyCodeBtnEl.className = 'btn btn-sm btn-light-primary';
                        copyButtonTimer = null;
                    }, 1800);
                }
            };

            const legacyCopyFromElement = (el) => {
                if (!el) return false;
                const selection = window.getSelection();
                const range = document.createRange();
                range.selectNodeContents(el);

                selection.removeAllRanges();
                selection.addRange(range);
                const success = document.execCommand('copy');
                selection.removeAllRanges();
                return success;
            };

            const legacyCopyFromTextarea = (text) => {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.opacity = '0';
                textArea.style.pointerEvents = 'none';
                textArea.style.top = '0';
                textArea.style.left = '0';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                const success = document.execCommand('copy');
                document.body.removeChild(textArea);
                return success;
            };

            const copyTextToClipboard = async (text) => {
                if (navigator.clipboard?.writeText) {
                    try {
                        await navigator.clipboard.writeText(text);
                        return true;
                    } catch (error) {
                        // Fallback to legacy method below
                    }
                }

                if (legacyCopyFromElement(codeBlockEl)) return true;
                return legacyCopyFromTextarea(text);
            };

            copyCodeBtnEl?.addEventListener('click', async () => {
                const codeText = currentCodeText || codeBlockEl.textContent || '';
                if (!codeText.trim() || codeText === 'Memuat source code...' || codeText ===
                    'Source kosong.' || codeText ===
                    'Gagal memuat source code.') {
                    updateCopyButtonState('Tidak ada code', 'btn-light-warning');
                    return;
                }

                try {
                    const copied = await copyTextToClipboard(codeText);
                    if (!copied) throw new Error('copy-failed');
                    updateCopyButtonState('Copied', 'btn-light-success');
                } catch (error) {
                    updateCopyButtonState('Copy gagal', 'btn-light-danger');
                }
            });

            previewTabBtnEl?.addEventListener('shown.bs.tab', () => {
                setCopyButtonVisible(false);
            });

            codeTabBtnEl?.addEventListener('shown.bs.tab', () => {
                setCopyButtonVisible(true);
            });

            document.addEventListener('click', async (e) => {
                const trigger = e.target.closest('.widget-preview-trigger');
                if (!trigger) return;

                e.preventDefault();
                const widget = trigger.getAttribute('data-widget');
                if (!widget) return;

                currentWidget = widget;
                currentCodeText = '';
                titleEl.textContent = 'Preview ' + widget;
                setLoading();
                setCopyButtonVisible(false);
                previewModal.show();
                previewTab?.show();

                try {
                    const frameUrl =
                        `{{ route('demo.widget-preview-frame') }}?widget=${encodeURIComponent(widget)}`;
                    previewPaneContentEl.className = 'p-0';
                    previewPaneContentEl.innerHTML =
                        `<iframe title="Preview ${widget}" src="${frameUrl}" style="width:100%;height:70vh;border:0;"></iframe>`;

                    const iframe = previewPaneContentEl.querySelector('iframe');
                    iframe.addEventListener('load', () => {
                        try {
                            const doc = iframe.contentDocument || iframe.contentWindow?.document;
                            const contentEl = doc?.querySelector('.widget-preview-content') || doc
                                ?.body;
                            const width = contentEl?.scrollWidth || 900;
                            resizeDialogToContent(width);
                        } catch (e) {
                            resizeDialogToContent(900);
                        }
                    });

                    const sourceUrl =
                        `{{ route('demo.widget-source') }}?widget=${encodeURIComponent(widget)}`;
                    const sourceRes = await fetch(sourceUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (!sourceRes.ok) {
                        throw new Error('Gagal memuat source code widget.');
                    }

                    const sourceData = await sourceRes.json();
                    if (currentWidget !== widget) return;

                    currentCodeText = sourceData.source || '';
                    codeBlockEl.textContent = currentCodeText || 'Source kosong.';
                } catch (err) {
                    setError(err?.message || 'Terjadi kesalahan saat memuat widget.');
                    codeBlockEl.textContent = 'Gagal memuat source code.';
                }
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                dialogEl.style.maxWidth = '900px';
                previewPaneContentEl.className = '';
                previewPaneContentEl.innerHTML = '';
                codeBlockEl.textContent = '';
                if (copyButtonTimer) {
                    clearTimeout(copyButtonTimer);
                    copyButtonTimer = null;
                }
                if (copyCodeBtnEl) {
                    copyCodeBtnEl.textContent = 'Copy Script';
                    copyCodeBtnEl.className = 'btn btn-sm btn-light-primary';
                }
                setCopyButtonVisible(false);
                currentWidget = '';
                currentCodeText = '';
            });
        })();
    </script>
    <!--end::Custom Javascript-->
@endsection
