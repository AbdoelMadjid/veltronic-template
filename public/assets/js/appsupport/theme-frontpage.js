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
        var iframe = document.getElementById("kt_preview_iframe");
        if (iframe) {
            iframe.src = iframe.src;
        }
    };

    // 1. Switch Active Theme (Landing vs Education)
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
                        Swal.fire({
                            text: res.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "OK, Selesai!",
                            customClass: { confirmButton: "btn btn-primary btn-sm" }
                        }).then(function () {
                            // Update UI cards & badges realtime
                            location.reload();
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

    // 8. Interactive Preview Switcher
    var initPreview = function () {
        $(".btn-preview-size").on("click", function () {
            $(".btn-preview-size").removeClass("active");
            $(this).addClass("active");
            var size = $(this).data("size");
            $("#kt_preview_container").css("width", size);
        });

        $("#kt_btn_refresh_preview").on("click", function () {
            refreshPreview();
            showToast("info", "Pratinjau disegarkan.");
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
        }
    };
}();

// Document Ready
KTUtil.onDOMContentLoaded(function () {
    KTThemeFrontpage.init();
});
