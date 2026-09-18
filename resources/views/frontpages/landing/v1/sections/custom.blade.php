@foreach($landingSections as $sec)
    @if(!empty($sec['is_custom']) && !empty($sec['is_active']))
        <!--begin::Custom Section - {{ $sec['name'] ?? '' }}-->
        <div class="py-10 py-lg-20" id="{{ $sec['anchor'] ?? '' }}">
            <div class="container">
                <div class="text-center mb-12">
                    <h3 class="fs-2hx text-gray-900 mb-4">{{ $sec['title'] ?? '' }}</h3>
                    @if(!empty($sec['subtitle']))
                        <div class="fs-5 text-muted fw-bold">{{ $sec['subtitle'] }}</div>
                    @endif
                </div>
                @if(!empty($sec['content_html']))
                    <div class="custom-section-content">
                        {!! $sec['content_html'] !!}
                    </div>
                @endif
            </div>
        </div>
        <!--end::Custom Section-->
    @endif
@endforeach
