@props([
    'user' => null,
    'size' => '40px',
    'class' => 'rounded-3',
    'id' => null,
    'asSymbol' => false,
    'symbolClass' => '',
    'showInitials' => false,
])

@php
    $u = $user instanceof \App\Models\UserManagement\User ? $user : auth()->user();
    $style = user_avatar_style($u);
    $hasAvatar = !empty($u?->avatar);

    $sizeClass = '';
    $inlineSize = '';
    $sizeVal = (string) $size;
    if (is_numeric($sizeVal)) {
        $sizeVal = $sizeVal . 'px';
    }
    if (str_contains($sizeVal, 'w-') || str_contains($sizeVal, 'h-')) {
        $sizeClass = $sizeVal;
    } else {
        $inlineSize = "width: {$sizeVal}; height: {$sizeVal};";
    }
@endphp

@if ($asSymbol)
    <div class="symbol {{ (is_numeric($size) || str_ends_with($sizeVal, 'px')) ? 'symbol-' . str_replace('px', '', $sizeVal) . 'px' : '' }} {{ $symbolClass }}">
        @if ($showInitials && !$hasAvatar)
            <div {{ $attributes->merge(['class' => "symbol-label fs-5 fw-bold bg-light-primary text-primary {$class}"]) }}
                 @if ($id) id="{{ $id }}" @endif
                 @if ($inlineSize) style="{{ $inlineSize }}" @endif>
                {{ $u?->initial ?? 'U' }}
            </div>
        @else
            <div {{ $attributes->merge(['class' => "image-input-wrapper {$sizeClass} {$class}"]) }}
                 @if ($id) id="{{ $id }}" @endif
                 style="{{ $style }} {{ $inlineSize }}">
            </div>
        @endif
    </div>
@else
    @if ($showInitials && !$hasAvatar)
        <div {{ $attributes->merge(['class' => "symbol-label fs-5 fw-bold bg-light-primary text-primary {$sizeClass} {$class}"]) }}
             @if ($id) id="{{ $id }}" @endif
             @if ($inlineSize) style="{{ $inlineSize }}" @endif>
            {{ $u?->initial ?? 'U' }}
        </div>
    @else
        <div {{ $attributes->merge(['class' => "image-input-wrapper {$sizeClass} {$class}"]) }}
             @if ($id) id="{{ $id }}" @endif
             style="{{ $style }} {{ $inlineSize }}">
        </div>
    @endif
@endif
