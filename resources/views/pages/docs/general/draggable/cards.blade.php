@extends('layouts.document832')
@section('styles')
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/prismjs/prismjs.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{--  --}}
@endsection
@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/prismjs/prismjs.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/draggable/draggable.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/documentation/general/draggable/cards.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Custom Javascript-->
@endsection
