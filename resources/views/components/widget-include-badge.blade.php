@props(['name', 'flexible' => false])

<div class="widget-include-badge" style="height:0;line-height:0;position:relative;z-index:2;overflow:visible;">
    <span class="badge badge-light-primary" style="position:relative;top:-8px;">{{ $name }}</span>
    @if ($flexible)
        <span class="badge badge-light-success" style="position:relative;top:-8px;">fleksible</span>
    @endif
</div>
