{{-- Global Session Flash Notification Auto-Renderer --}}
@if (session('success') || session('status') || session('error') || session('warning') || session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.Notify) {
                @if (session('success'))
                    Notify.success(@json(session('success')));
                @elseif (session('status'))
                    Notify.success(@json(session('status')));
                @elseif (session('error'))
                    Notify.error(@json(session('error')));
                @elseif (session('warning'))
                    Notify.warning(@json(session('warning')));
                @elseif (session('info'))
                    Notify.info(@json(session('info')));
                @endif
            }
        });
    </script>
@endif
