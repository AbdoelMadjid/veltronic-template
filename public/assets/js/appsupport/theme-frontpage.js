/**
 * Theme Frontpage Management JavaScript
 * Handles Zero-Reload Realtime CRUD, Theme & Version Switching, Menu Anchors, Sections & Footer Config.
 */
"use strict";

var KTThemeFrontpage = function () {
    // CSRF Setup
    var getCsrfToken = function () {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute("content") : "";
    };

    var showToast = function (type, message) {
        if (typeof toastr !== "undefined") {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toastr-top-right",
                timeOut: 3000
            };
            if (type === "success") toastr.success(message);
            else if (type === "error") toastr.error(message);
            else if (type === "warning") toastr.warning(message);
            else toastr.info(message);
        }
    };

    var setBtnLoading = function (btn, isLoading) {
        if (!btn) return;
        if (isLoading) {
            btn.setAttribute("data-kt-indicator", "on");
            btn.disabled = true;
        } else {
            btn.removeAttribute("data-kt-indicator");
            btn.disabled = false;
        }
    };

    var refreshPreview = function () {
        var iframeLanding = document.getElementById("kt_preview_iframe_landing");
        if (iframeLanding) {
            iframeLanding.src = iframeLanding.src;
        }
        var iframeEdu = document.getElementById("kt_preview_iframe_edu");
        if (iframeEdu) {
            iframeEdu.src = iframeEdu.src;
        }
        var iframeLegacy = document.getElementById("kt_preview_iframe");
        if (iframeLegacy) {
            iframeLegacy.src = iframeLegacy.src;
        }
    };

    // 1. Switch Active Theme (Landing vs Education) with Zero-Reload Realtime UI Update
    var initThemeSwitcher = function () {
        $(document).on("click", ".kt-btn-switch-frontpage", function (e) {
            e.preventDefault();
            var btn = this;
            var theme = $(btn).data("theme");

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/switch-theme",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { frontpage: theme },
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        // 1. Update Header Banner Theme Badges & Description
                        if (theme === "education") {
                            $("#badge_current_frontpage_theme").removeClass("badge-light-primary").addClass("badge-light-warning").text("EDUCATION");
                            $("#badge_current_frontpage_version").addClass("d-none");
                            $("#badge_current_education_multipage").removeClass("d-none");
                            $("#text_current_frontpage_desc").text("Kelola branding portal akademik, katalog rute multi-halaman (13 modul), preferensi topbar & navigasi, serta kontak & footer universitas.");
                            $("#nav_badge_theme_label").removeClass("badge-light-primary").addClass("badge-light-warning").text("Aktif: EDUCATION");

                            // 2. Update Theme Switcher Cards (Tab 1)
                            $("#card_theme_education").removeClass("border-gray-200").addClass("border-warning border-2");
                            $("#card_theme_education_badge").html('<span class="badge badge-warning fw-bold px-3 fs-7 text-white d-inline-flex align-items-center h-35px"><i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif</span>');
                            $("#card_theme_education_actions").html('<button type="button" class="btn btn-warning text-white btn-sm w-100 fw-bold disabled d-inline-flex align-items-center justify-content-center h-38px" disabled><i class="ki-outline ki-check fs-4 me-1"></i> Sedang Aktif</button><a href="/education" target="_blank" class="btn btn-light-warning btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px"><i class="ki-outline ki-eye fs-4 me-1"></i> Preview</a>');

                            $("#card_theme_landing").removeClass("border-primary border-2").addClass("border-gray-200");
                            $("#card_theme_landing_badge").html('<span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px">Tidak Aktif</span>');
                            $("#card_theme_landing_actions").html('<button type="button" class="btn btn-primary btn-sm w-100 fw-bold d-inline-flex align-items-center justify-content-center h-38px kt-btn-switch-frontpage" data-theme="landing"><span class="indicator-label d-inline-flex align-items-center"><i class="ki-outline ki-rocket fs-4 me-1"></i> Aktifkan Landing Page</span><span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...</span></button><a href="/landing" target="_blank" class="btn btn-light-primary btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px"><i class="ki-outline ki-eye fs-4 me-1"></i> Preview</a>');

                            // 3. Update Header Badges in Tab Containers
                            $("#header_landing_active_status").html('<span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px">Tidak Aktif</span><button type="button" class="btn btn-primary btn-sm fw-bold d-inline-flex align-items-center h-35px px-3 kt-btn-switch-frontpage" data-theme="landing"><span class="indicator-label d-inline-flex align-items-center"><i class="ki-outline ki-rocket fs-4 me-1"></i> Jadikan Tema Aktif</span><span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...</span></button><a href="/landing" target="_blank" class="btn btn-light-primary btn-sm fw-bold d-inline-flex align-items-center h-35px px-3"><i class="ki-outline ki-exit-right-corner fs-4 me-1"></i> Buka /landing</a>');
                            $("#header_education_active_status").html('<span class="badge badge-warning fw-bold px-3 fs-7 text-white d-inline-flex align-items-center h-35px"><i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif Publik</span><a href="/education" target="_blank" class="btn btn-light-warning btn-sm fw-bold d-inline-flex align-items-center h-35px px-3"><i class="ki-outline ki-exit-right-corner fs-4 me-1"></i> Buka /education</a>');

                            // 4. Update Legacy Preview Frame if present
                            $("#kt_preview_iframe").attr("src", "/education");
                            $("#kt_btn_preview_open_tab").attr("href", "/education");
                        } else {
                            $("#badge_current_frontpage_theme").removeClass("badge-light-warning").addClass("badge-light-primary").text("LANDING");
                            $("#badge_current_frontpage_version").removeClass("d-none");
                            $("#badge_current_education_multipage").addClass("d-none");
                            $("#text_current_frontpage_desc").text("Kelola pemilihan tema publik, tata letak navigasi anchor, branding logo, serta dinamisasi section konten & footer landing page.");
                            $("#nav_badge_theme_label").removeClass("badge-light-warning").addClass("badge-light-primary").text("Aktif: LANDING");

                            // 2. Update Theme Switcher Cards (Tab 1)
                            $("#card_theme_landing").removeClass("border-gray-200").addClass("border-primary border-2");
                            $("#card_theme_landing_badge").html('<span class="badge badge-success fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px"><i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif</span>');
                            $("#card_theme_landing_actions").html('<button type="button" class="btn btn-success btn-sm w-100 fw-bold disabled d-inline-flex align-items-center justify-content-center h-38px" disabled><i class="ki-outline ki-check fs-4 me-1"></i> Sedang Aktif</button><a href="/landing" target="_blank" class="btn btn-light-primary btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px"><i class="ki-outline ki-eye fs-4 me-1"></i> Preview</a>');

                            $("#card_theme_education").removeClass("border-warning border-2").addClass("border-gray-200");
                            $("#card_theme_education_badge").html('<span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px">Tidak Aktif</span>');
                            $("#card_theme_education_actions").html('<button type="button" class="btn btn-warning text-white btn-sm w-100 fw-bold d-inline-flex align-items-center justify-content-center h-38px kt-btn-switch-frontpage" data-theme="education"><span class="indicator-label d-inline-flex align-items-center"><i class="ki-outline ki-teacher fs-4 me-1"></i> Aktifkan Education Portal</span><span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...</span></button><a href="/education" target="_blank" class="btn btn-light-warning btn-sm fw-bold px-4 text-nowrap text-center d-inline-flex align-items-center justify-content-center h-38px"><i class="ki-outline ki-eye fs-4 me-1"></i> Preview</a>');

                            // 3. Update Header Badges in Tab Containers
                            $("#header_landing_active_status").html('<span class="badge badge-success fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px"><i class="ki-outline ki-check-circle fs-6 me-1 text-white"></i> Tema Aktif Publik</span><a href="/landing" target="_blank" class="btn btn-light-primary btn-sm fw-bold d-inline-flex align-items-center h-35px px-3"><i class="ki-outline ki-exit-right-corner fs-4 me-1"></i> Buka /landing</a>');
                            $("#header_education_active_status").html('<span class="badge badge-light-secondary fw-bold px-3 fs-7 d-inline-flex align-items-center h-35px">Tidak Aktif</span><button type="button" class="btn btn-warning text-white btn-sm fw-bold d-inline-flex align-items-center h-35px px-3 kt-btn-switch-frontpage" data-theme="education"><span class="indicator-label d-inline-flex align-items-center"><i class="ki-outline ki-teacher fs-4 me-1"></i> Jadikan Tema Aktif</span><span class="indicator-progress"><span class="spinner-border spinner-border-sm align-middle me-2"></span> Mengaktifkan...</span></button><a href="/education" target="_blank" class="btn btn-light-warning btn-sm fw-bold d-inline-flex align-items-center h-35px px-3"><i class="ki-outline ki-exit-right-corner fs-4 me-1"></i> Buka /education</a>');

                            // 4. Update Legacy Preview Frame if present
                            $("#kt_preview_iframe").attr("src", "/landing");
                            $("#kt_btn_preview_open_tab").attr("href", "/landing");
                        }

                        // Re-initialize tooltips for newly rendered elements
                        if (typeof bootstrap !== "undefined" && bootstrap.Tooltip) {
                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                            tooltipTriggerList.map(function (tooltipTriggerEl) {
                                return new bootstrap.Tooltip(tooltipTriggerEl);
                            });
                        }

                        Swal.fire({
                            text: res.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK, Paham",
                            customClass: { confirmButton: "btn btn-" + (theme === "education" ? "warning" : "primary") + " btn-sm" }
                        });
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Terjadi kesalahan saat mengganti tema.";
                    Swal.fire({ text: msg, icon: "error", buttonsStyling: false, confirmButtonText: "Tutup", customClass: { confirmButton: "btn btn-danger btn-sm" } });
                }
            });
        });

        // Switch Landing Version (v1, v2, etc.)
        $("#kt_btn_apply_landing_version").on("click", function (e) {
            e.preventDefault();
            var btn = this;
            var version = $("#kt_select_landing_version").val();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/switch-landing-version",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { version: version },
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal mengganti versi landing.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 2. Hero & Branding Form
    var initHeroForm = function () {
        $("#kt_form_landing_hero").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_hero");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/hero",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan konfigurasi hero.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 3. Logo Upload & Reset
    var initLogoForm = function () {
        $("#kt_form_landing_logos").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_logos");
            var formData = new FormData(form);

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/logo",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        if (res.data) {
                            if (res.data.landing_logo_light) {
                                $("#preview_landing_logo_light").attr("src", res.data.landing_logo_light + "?" + new Date().getTime());
                            }
                            if (res.data.landing_logo_dark) {
                                $("#preview_landing_logo_dark").attr("src", res.data.landing_logo_dark + "?" + new Date().getTime());
                            }
                            if (res.data.landing_favicon) {
                                $("#preview_landing_favicon").attr("src", res.data.landing_favicon + "?" + new Date().getTime());
                            }
                        }
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal mengunggah logo landing.";
                    showToast("error", msg);
                }
            });
        });

        // Reset Logo Button
        $("#kt_btn_reset_landing_logos").on("click", function (e) {
            e.preventDefault();
            Swal.fire({
                text: "Apakah Anda yakin ingin mereset seluruh logo landing page ke aset tema bawaan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Reset!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-warning btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/logo/reset",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        data: { type: "all" },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                showToast("success", res.message);
                                setTimeout(function () { location.reload(); }, 600);
                            }
                        }
                    });
                }
            });
        });
    };

    // 4. Menu Navigasi Realtime CRUD
    var initMenuManager = function () {
        var menuModalEl = document.getElementById("kt_modal_menu_form");
        var menuModal = menuModalEl ? new bootstrap.Modal(menuModalEl) : null;

        // Open Add Menu Modal
        $("#kt_btn_add_menu_item").on("click", function () {
            $("#modal_menu_title").text("Tambah Menu Navigasi Header");
            $("#input_menu_id").val("");
            $("#input_menu_title").val("");
            $("#input_menu_title_en").val("");
            $("#input_menu_target").val("#");
            $("#input_menu_order").val($("#kt_landing_menu_tbody tr.landing-menu-row").length + 1);
            $("#input_menu_external").prop("checked", false);
            $("#input_menu_active").prop("checked", true);
            if (menuModal) menuModal.show();
        });

        // Open Edit Menu Modal
        $(document).on("click", ".btn-edit-menu", function () {
            var btn = $(this);
            $("#modal_menu_title").text("Ubah Menu Navigasi Header");
            $("#input_menu_id").val(btn.data("id"));
            $("#input_menu_title").val(btn.data("title"));
            $("#input_menu_title_en").val(btn.data("title-en"));
            $("#input_menu_target").val(btn.data("target"));
            $("#input_menu_order").val(btn.data("order"));
            $("#input_menu_external").prop("checked", btn.data("external") == "1");
            $("#input_menu_active").prop("checked", btn.data("active") == "1");
            if (menuModal) menuModal.show();
        });

        // Select Anchor Suggestion
        $(document).on("click", ".select-anchor-opt", function (e) {
            e.preventDefault();
            var anchor = $(this).data("anchor");
            $("#input_menu_target").val(anchor);
        });

        // Submit Menu Form
        $("#kt_form_menu_modal").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_submit_menu");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/menu/save",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        if (menuModal) menuModal.hide();
                        showToast("success", res.message);
                        setTimeout(function () { location.reload(); }, 500);
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan item menu.";
                    showToast("error", msg);
                }
            });
        });

        // Toggle Menu Active Status
        $(document).on("change", ".menu-toggle-status", function () {
            var input = this;
            var id = $(input).data("id");

            $.ajax({
                url: "/appsupport/theme-frontpage/menu/toggle",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { id: id },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function () {
                    input.checked = !input.checked;
                    showToast("error", "Gagal memperbarui status menu.");
                }
            });
        });

        // Delete Menu Item
        $(document).on("click", ".btn-delete-menu", function () {
            var id = $(this).data("id");
            var title = $(this).data("title");
            var row = $(this).closest("tr");

            Swal.fire({
                text: "Hapus item menu navigasi '" + title + "'?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-danger btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/menu/delete",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        data: { id: id },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                showToast("success", res.message);
                                row.fadeOut(300, function () {
                                    row.remove();
                                    updateMenuOrderBadges();
                                });
                                refreshPreview();
                            }
                        }
                    });
                }
            });
        });

        // Menu Move Up / Down
        $(document).on("click", ".btn-menu-up", function () {
            var row = $(this).closest("tr");
            var prev = row.prev("tr.landing-menu-row");
            if (prev.length) {
                row.insertBefore(prev);
                reorderMenusAjax();
            }
        });

        $(document).on("click", ".btn-menu-down", function () {
            var row = $(this).closest("tr");
            var next = row.next("tr.landing-menu-row");
            if (next.length) {
                row.insertAfter(next);
                reorderMenusAjax();
            }
        });

        var updateMenuOrderBadges = function () {
            $("#kt_landing_menu_tbody tr.landing-menu-row").each(function (idx) {
                $(this).find(".menu-order-badge").text(idx + 1);
            });
        };

        var reorderMenusAjax = function () {
            var orders = [];
            $("#kt_landing_menu_tbody tr.landing-menu-row").each(function (idx) {
                var id = $(this).data("id");
                var order = idx + 1;
                $(this).find(".menu-order-badge").text(order);
                orders.push({ id: id, order: order });
            });

            $.ajax({
                url: "/appsupport/theme-frontpage/menu/reorder",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { orders: orders },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                }
            });
        };

        // Reset Menu Default
        $("#kt_btn_reset_menu_default").on("click", function () {
            Swal.fire({
                text: "Kembalikan seluruh susunan menu navigasi header ke standar awal bawaan tema?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Reset!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-warning btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/menu/reset",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                showToast("success", res.message);
                                setTimeout(function () { location.reload(); }, 500);
                            }
                        }
                    });
                }
            });
        });
    };

    // 5. Sections Manager Realtime CRUD
    var initSectionsManager = function () {
        var sectionModalEl = document.getElementById("kt_modal_section_form");
        var sectionModal = sectionModalEl ? new bootstrap.Modal(sectionModalEl) : null;

        // Open Add Custom Section Modal
        $("#kt_btn_add_custom_section").on("click", function () {
            $("#modal_section_title").text("Tambah Section Kustom Baru");
            $("#input_section_id").val("");
            $("#input_section_is_custom").val("1");
            $("#input_section_name").val("");
            $("#input_section_anchor").val("");
            $("#input_section_title").val("");
            $("#input_section_subtitle").val("");
            $("#input_section_icon").val("ki-element-plus");
            $("#input_section_badge").val("Custom");
            $("#input_section_order").val($("#kt_landing_sections_tbody tr.landing-section-row").length + 1);
            $("#input_section_content_html").val("");
            $("#wrapper_custom_html_content").show();
            $("#input_section_active").prop("checked", true);
            if (sectionModal) sectionModal.show();
        });

        // Open Edit Section Modal
        $(document).on("click", ".btn-edit-section", function () {
            var btn = $(this);
            var isCustom = btn.data("custom") == "1";
            var rawContent = btn.data("content") ? atob(btn.data("content")) : "";

            $("#modal_section_title").text("Ubah Konfigurasi Section (" + btn.data("name") + ")");
            $("#input_section_id").val(btn.data("id"));
            $("#input_section_is_custom").val(isCustom ? "1" : "0");
            $("#input_section_name").val(btn.data("name"));
            $("#input_section_anchor").val(btn.data("anchor"));
            $("#input_section_title").val(btn.data("title"));
            $("#input_section_subtitle").val(btn.data("subtitle"));
            $("#input_section_icon").val(btn.data("icon"));
            $("#input_section_badge").val(btn.data("badge"));
            $("#input_section_order").val(btn.data("order"));
            $("#input_section_content_html").val(rawContent);
            $("#input_section_active").prop("checked", btn.data("active") == "1");

            if (isCustom) {
                $("#wrapper_custom_html_content").show();
            } else {
                $("#wrapper_custom_html_content").hide();
            }

            if (sectionModal) sectionModal.show();
        });

        // Submit Section Form
        $("#kt_form_section_modal").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_submit_section");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/sections/save",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        if (sectionModal) sectionModal.hide();
                        showToast("success", res.message);
                        setTimeout(function () { location.reload(); }, 500);
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan section.";
                    showToast("error", msg);
                }
            });
        });

        // Toggle Section Active Status
        $(document).on("change", ".section-toggle-status", function () {
            var input = this;
            var id = $(input).data("id");

            $.ajax({
                url: "/appsupport/theme-frontpage/sections/toggle",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { id: id },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function () {
                    input.checked = !input.checked;
                    showToast("error", "Gagal mengubah status section.");
                }
            });
        });

        // Delete Custom Section
        $(document).on("click", ".btn-delete-section", function () {
            var id = $(this).data("id");
            var name = $(this).data("name");
            var row = $(this).closest("tr");

            Swal.fire({
                text: "Hapus section kustom '" + name + "'?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-danger btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/sections/delete",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        data: { id: id },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                showToast("success", res.message);
                                row.fadeOut(300, function () { row.remove(); });
                                refreshPreview();
                            }
                        }
                    });
                }
            });
        });

        // Move Section Up / Down
        $(document).on("click", ".btn-section-up", function () {
            var row = $(this).closest("tr");
            var prev = row.prev("tr.landing-section-row");
            if (prev.length) {
                row.insertBefore(prev);
                reorderSectionsAjax();
            }
        });

        $(document).on("click", ".btn-section-down", function () {
            var row = $(this).closest("tr");
            var next = row.next("tr.landing-section-row");
            if (next.length) {
                row.insertAfter(next);
                reorderSectionsAjax();
            }
        });

        var reorderSectionsAjax = function () {
            var orders = [];
            $("#kt_landing_sections_tbody tr.landing-section-row").each(function (idx) {
                var id = $(this).data("id");
                var order = idx + 1;
                $(this).find(".section-order-badge").text(order);
                orders.push({ id: id, order: order });
            });

            $.ajax({
                url: "/appsupport/theme-frontpage/sections/reorder",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { orders: orders },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                }
            });
        };

        // Reset Sections Default
        $("#kt_btn_reset_sections_default").on("click", function () {
            Swal.fire({
                text: "Kembalikan seluruh daftar section ke urutan dan pengaturan standar bawaan tema?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Reset!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-warning btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/sections/reset",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                showToast("success", res.message);
                                setTimeout(function () { location.reload(); }, 500);
                            }
                        }
                    });
                }
            });
        });

        // ----------------------------------------------------
        // Code Editor Modal for Sections (GUI Script Editor)
        // ----------------------------------------------------
        var codeModalEl = document.getElementById("modal_section_code");
        var codeModal = codeModalEl ? new bootstrap.Modal(codeModalEl) : null;

        $(document).on("click", ".btn-edit-section-code", function () {
            var btn = $(this);
            var sectionId = btn.data("id");
            var sectionName = btn.data("name") || sectionId;
            var isCustom = btn.data("custom") == "1";
            var version = $("#code_editor_version").val() || "v1";

            $("#section_code_modal_title").text("Editor Script / Blade (" + sectionName + ")");
            $("#code_editor_section_id").val(sectionId);
            $("#section_code_badge_type").text(isCustom ? "Seksi Kustom HTML" : "Seksi Bawaan Template");
            $("#section_code_file_path").text("Memuat script...");
            $("#section_code_content").val("Memuat isi script...");

            if (codeModal) codeModal.show();

            $.ajax({
                url: "/appsupport/theme-frontpage/sections/get-code",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: { section_id: sectionId, version: version },
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        $("#section_code_file_path").text(res.file_path);
                        $("#section_code_content").val(res.code);
                    }
                },
                error: function (xhr) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal memuat source code seksi.";
                    $("#section_code_file_path").text("Gagal memuat");
                    $("#section_code_content").val("/* " + msg + " */");
                }
            });
        });

        // Submit Code Editor Form
        $("#form_section_code").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("btn_submit_section_code");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/sections/save-code",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        if (codeModal) codeModal.hide();
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan source code seksi.";
                    showToast("error", msg);
                }
            });
        });

        // Auto wrap toggle
        $("#btn_format_code").on("click", function () {
            var textarea = $("#section_code_content");
            var currentWrap = textarea.attr("wrap");
            if (currentWrap === "off") {
                textarea.attr("wrap", "soft");
                showToast("info", "Auto-wrap diaktifkan.");
            } else {
                textarea.attr("wrap", "off");
                showToast("info", "Auto-wrap dinonaktifkan.");
            }
        });

        // Reset section code
        $("#btn_reset_section_code").on("click", function () {
            var sectionId = $("#code_editor_section_id").val();
            if (!sectionId) return;

            Swal.fire({
                text: "Segarkan editor dan muat ulang script asli dari file?",
                icon: "question",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Muat Ulang",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-warning btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    var version = $("#code_editor_version").val() || "v1";
                    $.ajax({
                        url: "/appsupport/theme-frontpage/sections/get-code",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        data: { section_id: sectionId, version: version },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                $("#section_code_content").val(res.code);
                                showToast("success", "Script asli berhasil dimuat ulang.");
                            }
                        }
                    });
                }
            });
        });
    };

    // 6. Footer & Kontak Form
    var initFooterForm = function () {
        $("#kt_form_landing_footer").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_footer");

            // Collect social links array
            var socialLinks = [];
            $("#kt_landing_social_inputs .social-input-row").each(function () {
                var row = $(this);
                socialLinks.push({
                    name: row.find(".soc-name").val(),
                    icon: row.find(".soc-icon").val(),
                    url: row.find(".soc-url").val(),
                    is_active: row.find(".soc-active").is(":checked")
                });
            });

            var payload = $(form).serializeArray();
            payload.push({ name: "landing_social_links", value: JSON.stringify(socialLinks) });

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/footer",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: $.param(payload),
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan footer & kontak.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 7. Global Actions: Clear Cache & Reset All
    var initGlobalActions = function () {
        $("#kt_btn_clear_frontpage_cache").on("click", function () {
            var btn = this;
            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/clear-cache",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function () {
                    setBtnLoading(btn, false);
                    showToast("error", "Gagal membersihkan cache.");
                }
            });
        });

        $("#kt_btn_reset_frontpage_all").on("click", function () {
            Swal.fire({
                text: "Kembalikan seluruh pengaturan landing page (Hero, Logo, Menu, Section, dan Footer) ke setelan default pabrikan?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Reset Total!",
                cancelButtonText: "Batal",
                customClass: { confirmButton: "btn btn-danger btn-sm", cancelButton: "btn btn-light btn-sm" }
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/appsupport/theme-frontpage/reset-all",
                        type: "POST",
                        headers: { "X-CSRF-TOKEN": getCsrfToken() },
                        dataType: "json",
                        success: function (res) {
                            if (res.success) {
                                Swal.fire({
                                    text: res.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Selesai",
                                    customClass: { confirmButton: "btn btn-primary btn-sm" }
                                }).then(function () {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    };

    // 8. Interactive Preview Switchers (Landing & Education)
    var initPreview = function () {
        // Landing Preview
        $(document).on("click", ".btn-preview-size-landing", function () {
            $(".btn-preview-size-landing").removeClass("active");
            $(this).addClass("active");
            var size = $(this).data("size");
            $("#kt_preview_container_landing").css("width", size);
        });

        $(document).on("click", "#kt_btn_refresh_preview_landing", function () {
            var iframe = document.getElementById("kt_preview_iframe_landing");
            if (iframe) {
                iframe.src = iframe.src;
            }
            showToast("info", "Pratinjau Landing Page disegarkan.");
        });

        // Education Preview
        $(document).on("click", ".btn-preview-size-edu", function () {
            $(".btn-preview-size-edu").removeClass("active");
            $(this).addClass("active");
            var size = $(this).data("size");
            $("#kt_preview_container_edu").css("width", size);
        });

        $(document).on("click", "#kt_btn_refresh_preview_edu", function () {
            var iframe = document.getElementById("kt_preview_iframe_edu");
            if (iframe) {
                iframe.src = iframe.src;
            }
            showToast("info", "Pratinjau Education Portal disegarkan.");
        });

        // Universal fallback
        $(document).on("click", ".btn-preview-size", function () {
            $(".btn-preview-size").removeClass("active");
            $(this).addClass("active");
            var size = $(this).data("size");
            $("#kt_preview_container").css("width", size);
        });

        $(document).on("click", "#kt_btn_refresh_preview", function () {
            refreshPreview();
            showToast("info", "Pratinjau disegarkan.");
        });
    };

    // 9. Education Portal: Info & Branding Form
    var initEduInfoForm = function () {
        $("#kt_form_edu_info").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_edu_info");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/education/info",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan info portal education.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 10. Education Portal: Logo Upload & Reset
    var initEduLogoForm = function () {
        $("#kt_form_edu_logos").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_edu_logo");
            var formData = new FormData(form);

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/education/logo",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        if (res.data) {
                            if (res.data.education_logo_light) $("#img_preview_edu_logo_light").attr("src", res.data.education_logo_light);
                            if (res.data.education_logo_dark) $("#img_preview_edu_logo_dark").attr("src", res.data.education_logo_dark);
                            if (res.data.education_favicon) $("#img_preview_edu_favicon").attr("src", res.data.education_favicon);
                        }
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal mengunggah logo education.";
                    showToast("error", msg);
                }
            });
        });

        $("#kt_btn_reset_edu_logo").on("click", function (e) {
            e.preventDefault();
            var btn = this;
            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/education/logo/reset",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        $("#img_preview_edu_logo_light").attr("src", "/assets/img/logo/logo.png");
                        $("#img_preview_edu_logo_dark").attr("src", "/assets/img/logo/logo-mini.png");
                        $("#img_preview_edu_favicon").attr("src", "/assets/img/logo/logo-mini.png");
                        refreshPreview();
                    }
                },
                error: function () {
                    setBtnLoading(btn, false);
                    showToast("error", "Gagal mereset logo education.");
                }
            });
        });
    };

    // 11. Education Portal: Topbar & Navigasi Form
    var initEduNavForm = function () {
        $("#kt_form_edu_nav").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_edu_nav");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/education/nav",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan navigasi portal education.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 12. Education Portal: Footer & Kontak Form
    var initEduFooterForm = function () {
        $("#kt_form_edu_footer").on("submit", function (e) {
            e.preventDefault();
            var form = this;
            var btn = document.getElementById("kt_btn_save_edu_footer");
            var formData = $(form).serialize();

            setBtnLoading(btn, true);

            $.ajax({
                url: "/appsupport/theme-frontpage/education/footer",
                type: "POST",
                headers: { "X-CSRF-TOKEN": getCsrfToken() },
                data: formData,
                dataType: "json",
                success: function (res) {
                    setBtnLoading(btn, false);
                    if (res.success) {
                        showToast("success", res.message);
                        refreshPreview();
                    }
                },
                error: function (xhr) {
                    setBtnLoading(btn, false);
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Gagal menyimpan footer portal education.";
                    showToast("error", msg);
                }
            });
        });
    };

    // 13. Education Portal: Pages Filter
    var initEduPagesFilter = function () {
        $("#kt_edu_pages_search").on("keyup", function () {
            var val = $(this).val().toLowerCase().trim();
            $("#kt_edu_pages_tbody .edu-page-row").each(function () {
                var searchData = $(this).data("search") || "";
                if (val === "" || searchData.indexOf(val) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    };

    return {
        init: function () {
            initThemeSwitcher();
            initHeroForm();
            initLogoForm();
            initMenuManager();
            initSectionsManager();
            initFooterForm();
            initGlobalActions();
            initPreview();
            initEduInfoForm();
            initEduLogoForm();
            initEduNavForm();
            initEduFooterForm();
            initEduPagesFilter();
        }
    };
}();

// Document Ready
KTUtil.onDOMContentLoaded(function () {
    KTThemeFrontpage.init();
});
