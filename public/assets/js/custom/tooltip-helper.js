/**
 * Veltronic Tooltip Helper
 * Menangani perilaku tooltip secara universal, terutama pada perangkat mobile/touch:
 * 1. Otomatis menutup tooltip saat tombol diklik / dieksekusi.
 * 2. Otomatis membersihkan tooltip yang tertinggal saat modal ditutup / berganti tab.
 * 3. Menghilangkan tooltip saat pengguna menyentuh area lain di layar.
 * 4. Memberikan batas waktu tayang (auto-dismiss timeout) pada perangkat touch agar tidak macet di layar.
 */
(function () {
    "use strict";

    const isTouchDevice = () => {
        return (
            "ontouchstart" in window ||
            navigator.maxTouchPoints > 0 ||
            window.matchMedia("(hover: none)").matches
        );
    };

    /**
     * Sembunyikan semua tooltip yang sedang aktif di dokumen
     */
    const hideAllTooltips = () => {
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach((el) => {
            const instance = bootstrap.Tooltip.getInstance(el);
            if (instance) {
                instance.hide();
            }
        });

        // Hapus elemen DOM tooltip orphan yang mungkin tertinggal
        const orphanTooltips = document.querySelectorAll(".tooltip.show, .tooltip.fade");
        orphanTooltips.forEach((el) => {
            el.remove();
        });
    };

    /**
     * Sembunyikan tooltip pada elemen tertentu
     */
    const hideTooltip = (el) => {
        if (!el) return;
        const triggerEl = el.closest('[data-bs-toggle="tooltip"]');
        if (triggerEl) {
            const instance = bootstrap.Tooltip.getInstance(triggerEl);
            if (instance) {
                instance.hide();
            }
            if (typeof triggerEl.blur === "function") {
                triggerEl.blur();
            }
        }
    };

    // 1. Event Klik Global: Tutup tooltip segera setelah tombol/link dengan tooltip diklik
    document.addEventListener(
        "click",
        function (e) {
            const target = e.target;
            const tooltipTrigger = target.closest('[data-bs-toggle="tooltip"]');
            if (tooltipTrigger) {
                hideTooltip(tooltipTrigger);
            }
        },
        true
    );

    // 2. Event Touch / Tap di luar elemen tooltip: Tutup semua tooltip
    document.addEventListener(
        "touchstart",
        function (e) {
            const target = e.target;
            const tooltipTrigger = target.closest('[data-bs-toggle="tooltip"]');
            if (!tooltipTrigger) {
                // Sentuhan di luar pemicu tooltip, tutup tooltip aktif
                hideAllTooltips();
            }
        },
        { passive: true }
    );

    // 3. Auto-dismiss timer saat tooltip muncul (khusus perangkat sentuh / mobile)
    document.addEventListener("shown.bs.tooltip", function (e) {
        const triggerEl = e.target;
        if (isTouchDevice()) {
            // Pada touch screen, berikan batas tayang 1.5 detik agar tidak menempel terus
            setTimeout(function () {
                hideTooltip(triggerEl);
            }, 1500);
        }
    });

    // 4. Bersihkan tooltip saat modal / drawer / tab sedang atau telah ditutup
    const cleanupEvents = [
        "hide.bs.modal",
        "hidden.bs.modal",
        "show.bs.modal",
        "hide.bs.drawer",
        "hidden.bs.drawer",
        "hide.bs.tab",
        "show.bs.tab",
        "hide.bs.dropdown",
        "show.bs.dropdown",
    ];

    cleanupEvents.forEach(function (eventName) {
        document.addEventListener(eventName, function () {
            hideAllTooltips();
        });
    });

    // Expose utility globally
    window.VeltronicTooltip = {
        hideAll: hideAllTooltips,
        hide: hideTooltip,
    };
})();
