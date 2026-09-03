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
            Skema Pemrograman
        @endslot
        @slot('li_3')
            Console Developer
        @endslot
    @endcomponent
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="schema-shell">
                <div class="schema-hero">
                    <span class="schema-pill">Developer Utility</span>
                    <h2 class="fw-bold">Console Developer</h2>
                    <p class="schema-lead">
                        Halaman referensi dan cheatsheet perintah CLI untuk Git/GitHub dan PHP Artisan.
                    </p>
                </div>

                <div class="card border">
                    <div class="card-body p-8 text-center">
                        <div class="py-10">
                            <i class="ki-duotone ki-code fs-3x text-primary mb-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                            <h3 class="fw-bold text-gray-800 mb-2">Segera Hadir / Work in Progress</h3>
                            <p class="text-muted fs-6 mb-0">
                                Daftar perintah GitHub & PHP Artisan akan ditambahkan pada halaman ini.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
