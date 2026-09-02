@php
    $demoWidgetMap = [];
    $demoDir = resource_path('views/pages/demo');
    $demoFiles = \Illuminate\Support\Facades\File::allFiles($demoDir);

    foreach ($demoFiles as $demoFile) {
        $relativePath = str_replace('\\', '/', $demoFile->getRelativePathname());

        if (!preg_match('/^(sepuluh[a-z]+\/demo(\d+))\.blade\.php$/', $relativePath, $demoMatch)) {
            continue;
        }

        $demoKey = $demoMatch[1];
        $demoNumber = (int) $demoMatch[2];
        $fileContent = \Illuminate\Support\Facades\File::get($demoFile->getPathname());
        preg_match_all("/@include\('partials\.widgets-demo\.([^']+)'/", $fileContent, $widgetMatches);

        $widgets = array_values(array_unique($widgetMatches[1] ?? []));
        natsort($widgets);

        $demoWidgetMap[$demoKey] = [
            'number' => $demoNumber,
            'widgets' => array_values($widgets),
        ];
    }

    uasort($demoWidgetMap, function ($a, $b) {
        if ($a['number'] === $b['number']) {
            return 0;
        }
        return $a['number'] <=> $b['number'];
    });
@endphp

<div class="card mt-8">
    <div class="card-header border-0 pt-6">
        <div class="d-flex flex-column">
            <h3 class="card-title mb-1">Distribusi Widget per Demo</h3>
            <span class="text-muted fs-7">
                Klik judul demo pada header box untuk membuka halaman demo. Klik nama widget untuk preview.
            </span>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="widget-distribution-grid">
            @foreach ($demoWidgetMap as $demo => $meta)
                @php
                    $widgets = $meta['widgets'];
                @endphp
                <div class="widget-category-box">
                    <div class="widget-category-head">
                        <h5 class="widget-category-title mb-0">
                            <a href="{{ url('demo/' . $demo) }}" target="_blank" rel="noopener noreferrer"
                                class="text-gray-800 text-hover-primary">
                                Demo {{ $meta['number'] }}
                            </a>
                        </h5>
                        <span class="badge badge-light-primary fw-semibold widget-category-count">
                            {{ count($widgets) }} widget
                        </span>
                    </div>
                    <div class="widget-category-body">
                        @forelse ($widgets as $widget)
                            <div class="widget-row-box">
                                <a href="#"
                                    class="widget-preview-trigger text-gray-800 text-hover-primary fw-semibold"
                                    data-widget="{{ $widget }}">
                                    <code>{{ $widget }}</code>
                                </a>
                            </div>
                        @empty
                            <span class="text-muted fs-7">Tidak ada widget terdeteksi.</span>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
