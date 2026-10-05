@extends('layouts.index')

@section('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.css', $theme_asset_pack ?? null) }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <style>
        .chat-bubble-container {
            transition: background-color 0.3s ease;
            max-width: 100%;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .emoji-btn-item {
            font-size: 1.35rem;
            line-height: 1;
            padding: 5px;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.1s ease, background-color 0.1s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .emoji-btn-item:hover {
            transform: scale(1.3);
            background-color: var(--bs-gray-200);
        }
        .reaction-badge {
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }
        .reaction-badge:hover {
            transform: scale(1.1);
        }
        .reaction-badge.active {
            background-color: rgba(var(--bs-primary-rgb), 0.15) !important;
            border-color: var(--bs-primary) !important;
            color: var(--bs-primary) !important;
        }
        .chat-reaction-popover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-radius: 30px;
            padding: 4px 8px;
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-gray-300);
            z-index: 1050;
            white-space: nowrap;
            max-width: calc(100vw - 30px);
            pointer-events: auto;
        }

        /* Typing Dots Keyframes Animation */
        @keyframes typingBounce {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
            30% { transform: translateY(-4px); opacity: 1; }
        }
        .typing-dot {
            display: inline-block;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background-color: var(--bs-primary);
            animation: typingBounce 1.4s infinite ease-in-out;
        }
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }

        /* Search in Thread Highlight Animation */
        .chat-search-highlight {
            background-color: #fef08a !important;
            color: #854d0e !important;
            border-radius: 4px;
            padding: 1px 4px;
            font-weight: 700;
            box-shadow: 0 0 0 2px rgba(234, 179, 8, 0.4);
            transition: all 0.2s ease;
        }
        .chat-search-active-bubble {
            box-shadow: 0 0 0 3px var(--bs-warning) !important;
            border-radius: 8px !important;
        }

        /* Scope zero-scroll strictly to chat row while preserving standard Metronic layout & footer */
        @media (min-width: 992px) {
            #kt_chat_layout_row {
                height: calc(100vh - 250px) !important;
                max-height: calc(100vh - 250px) !important;
                min-height: 350px !important;
                overflow: hidden !important;
            }
            #kt_chat_sidebar_col,
            #kt_chat_messenger_col {
                height: 100% !important;
                max-height: 100% !important;
                min-height: 0 !important;
                overflow: hidden !important;
            }
            #kt_chat_contacts_card,
            #kt_chat_messenger {
                height: 100% !important;
                max-height: 100% !important;
                min-height: 0 !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
            }
            #kt_chat_contacts_header,
            #kt_chat_messenger_header {
                flex-shrink: 0 !important;
            }
            #kt_chat_contacts_body,
            #kt_chat_messenger_body {
                flex: 1 1 0% !important;
                min-height: 0 !important;
                height: auto !important;
                overflow: hidden !important;
                display: flex !important;
                flex-direction: column !important;
            }
            #chat_contacts_list,
            #chat_messages_scroll {
                flex: 1 1 0% !important;
                min-height: 0 !important;
                height: 100% !important;
                max-height: 100% !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
            }
            #kt_chat_messenger_footer {
                margin-top: auto !important;
                flex-shrink: 0 !important;
            }
        }
        @media (max-width: 991.98px) {
            #chat_contacts_list {
                max-height: 280px !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
            }
            #chat_messages_scroll {
                min-height: 260px !important;
                max-height: 420px !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
            }
        }
    </style>
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Apps
        @endslot
        @slot('li_2')
            Chat
        @endslot
    @endcomponent
@endsection

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row align-items-lg-stretch" id="kt_chat_layout_row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-280px w-xl-325px w-xxl-380px mb-6 mb-lg-0 d-flex flex-column" id="kt_chat_sidebar_col">
                    <!--begin::Contacts-->
                    <div class="card card-flush h-100 d-flex flex-column" id="kt_chat_contacts_card">
                        <!--begin::Card header-->
                        <div class="card-header pt-5 pb-3 flex-shrink-0" id="kt_chat_contacts_header">
                            <!--begin::Form-->
                            <form class="w-100 position-relative" autocomplete="off" onsubmit="return false;">
                                <!--begin::Icon-->
                                <i
                                    class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid px-13" name="search"
                                    id="chat_contact_search_input" value="" placeholder="Search by username or email..." />
                                <!--end::Input-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-5 d-flex flex-column flex-grow-1 overflow-hidden" id="kt_chat_contacts_body">
                            <!--begin::List-->
                            <div class="scroll-y me-n5 pe-5 flex-grow-1" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                                data-kt-scroll-offset="5px" id="chat_contacts_list">
                                <div class="d-flex align-items-center justify-content-center py-10" id="chat_contacts_loading">
                                    <div class="spinner-border spinner-border-sm text-primary me-2"></div>
                                    <span class="text-muted fs-7">Memuat daftar kontak...</span>
                                </div>
                            </div>
                            <!--end::List-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Contacts-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-5 ms-xl-7 d-flex flex-column min-w-0" id="kt_chat_messenger_col">
                    <!--begin::Messenger-->
                    <div class="card h-100 d-flex flex-column" id="kt_chat_messenger">
                        <!--begin::Card header-->
                        <div class="card-header pt-4 pb-3 flex-shrink-0 flex-wrap gap-2" id="kt_chat_messenger_header">
                            <!--begin::Title-->
                            <div class="card-title">
                                <!--begin::User-->
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <a href="javascript:void(0)"
                                        class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="chat_header_user_name">
                                        {{ $selectedUser ? $selectedUser->name : 'Ruang Obrolan' }}
                                    </a>
                                    <!--begin::Info-->
                                    <div class="mb-0 lh-1">
                                        <span class="badge badge-success badge-circle w-10px h-10px me-1 {{ ($selectedUser && ($selectedUser->is_online ?? false)) ? '' : 'd-none' }}" id="chat_header_presence_dot"></span>
                                        <span class="fs-7 fw-semibold text-muted" id="chat_header_user_status">
                                            {{ $selectedUser ? (($selectedUser->is_online ?? false) ? 'Active' : 'Offline') : 'Pilih pengguna untuk mulai chat' }}
                                        </span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar d-flex align-items-center gap-1">
                                <!--begin::Search in Thread Toggle Button-->
                                <button class="btn btn-sm btn-icon btn-active-light-primary" type="button"
                                    id="chat_btn_toggle_search" data-bs-toggle="tooltip" data-bs-placement="top" title="Cari di Percakapan">
                                    <i class="ki-duotone ki-magnifier fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                                <!--end::Search in Thread Toggle Button-->

                                <!--begin::Menu-->
                                <div class="me-n3">
                                    <button class="btn btn-sm btn-icon btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-dots-square fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-225px py-3"
                                        data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                Percakapan
                                            </div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3" id="chat_btn_export_txt">
                                                <i class="ki-duotone ki-file-down fs-4 text-primary me-2"><span class="path1"></span><span class="path2"></span></i>
                                                Ekspor Chat (.txt)
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3 mt-2">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                Contacts
                                            </div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link px-3" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_users_search">Add Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" class="menu-link flex-stack px-3" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_invite_friends">Invite Contacts
                                                <span class="ms-2" data-bs-toggle="tooltip"
                                                    title="Specify a contact email to send an invitation">
                                                    <i class="ki-duotone ki-information fs-7">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i> </span></a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 3-->
                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Inline Search Thread Bar (Collapsible)-->
                        <div class="px-5 py-2 bg-light-primary bg-opacity-50 border-bottom border-gray-200 d-none align-items-center justify-content-between gap-2 shadow-xs" id="chat_thread_search_bar">
                            <div class="d-flex align-items-center gap-2 flex-grow-1">
                                <i class="ki-duotone ki-magnifier fs-4 text-primary"><span class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control-sm form-control-solid bg-body border-0 fs-7" id="chat_in_thread_search_input" placeholder="Cari pesan dalam percakapan..." autocomplete="off" />
                                <span class="fs-8 text-muted text-nowrap fw-semibold" id="chat_search_match_count">0 hasil</span>
                            </div>
                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary w-25px h-25px" id="chat_btn_search_prev" title="Sebelumnya">
                                    <i class="ki-duotone ki-up fs-6"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary w-25px h-25px" id="chat_btn_search_next" title="Berikutnya">
                                    <i class="ki-duotone ki-down fs-6"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light-danger btn-active-danger w-25px h-25px ms-1" id="chat_btn_close_search" title="Tutup Pencarian">
                                    <i class="ki-duotone ki-cross fs-6"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                        </div>
                        <!--end::Inline Search Thread Bar-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column flex-grow-1 overflow-hidden" id="kt_chat_messenger_body">
                            <!--begin::Pinned Banner (if any)-->
                            <div class="p-3 bg-light-warning bg-opacity-75 rounded-3 border border-warning border-dashed mb-4 d-none align-items-center justify-content-between shadow-xs flex-shrink-0" id="chat_pinned_banner">
                                <div class="d-flex align-items-center gap-3 overflow-hidden cursor-pointer flex-grow-1" id="chat_pinned_jump_btn" title="Klik untuk melompat ke pesan yang disematkan">
                                    <i class="ki-duotone ki-pin fs-2 text-warning flex-shrink-0"><span class="path1"></span><span class="path2"></span></i>
                                    
                                    <div id="chat_pinned_thumb_wrapper" class="d-none rounded-2 overflow-hidden border border-gray-300 flex-shrink-0 shadow-xs" style="width: 38px; height: 38px; min-width: 38px;">
                                        <img id="chat_pinned_thumb" src="" alt="Foto" class="w-100 h-100 object-fit-cover d-block" />
                                    </div>
                                    <div id="chat_pinned_file_icon" class="d-none d-flex align-items-center justify-content-center bg-light-primary text-primary rounded-2 flex-shrink-0" style="width: 38px; height: 38px; min-width: 38px;">
                                        <i class="ki-duotone ki-file fs-3 text-primary"><span class="path1"></span><span class="path2"></span></i>
                                    </div>

                                    <div class="overflow-hidden text-start flex-grow-1">
                                        <div class="fs-8 fw-bold text-warning text-uppercase d-flex align-items-center gap-2">
                                            <span>Pesan Disematkan</span>
                                            <span class="badge badge-light-warning fs-9 fw-bold d-none" id="chat_pinned_badge">Foto</span>
                                        </div>
                                        <div class="fs-7 text-gray-900 fw-semibold text-truncate mw-300px mw-sm-450px" id="chat_pinned_text">...</div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-icon btn-active-light-warning flex-shrink-0 ms-2" id="chat_btn_unpin_current" data-bs-toggle="tooltip" title="Lepas Sematan">
                                    <i class="ki-duotone ki-cross fs-4"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                            <!--end::Pinned Banner-->

                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5 flex-grow-1" data-kt-element="messages"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer, #chat_pinned_banner"
                                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                data-kt-scroll-offset="5px" id="chat_messages_scroll">
                                <div id="chat_messages_thread" class="d-flex flex-column">
                                    @if(empty($selectedUserId))
                                        <div class="d-flex flex-column align-items-center justify-content-center text-center p-8 my-auto" style="min-height: 380px;">
                                            <div class="symbol symbol-75px symbol-circle bg-light-primary mb-5 d-flex align-items-center justify-content-center shadow-xs">
                                                <i class="ki-duotone ki-messages fs-2tx text-primary">
                                                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                </i>
                                            </div>
                                            <h3 class="fs-4 fw-bolder text-gray-900 mb-2">Pilih Pengguna untuk Memulai Percakapan</h3>
                                            <p class="fs-7 text-muted mw-375px mb-5">
                                                Pilih salah satu kontak dari daftar obrolan di sebelah kiri untuk membuka riwayat pesan dan saling bertukar kabar.
                                            </p>
                                            <div class="d-inline-flex align-items-center gap-2 text-muted fs-8 bg-light bg-opacity-75 py-2 px-4 rounded-pill border border-gray-200">
                                                <i class="ki-duotone ki-shield-tick fs-5 text-success"><span class="path1"></span><span class="path2"></span></i>
                                                <span>Percakapan privat & aman real-time</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer (PATEN DI BAWAH)-->
                        <div class="card-footer pt-4 mt-auto flex-shrink-0" id="kt_chat_messenger_footer">
                            <form id="chat_message_form" onsubmit="return false;">
                                @csrf
                                <input type="hidden" name="target_user_id" id="chat_form_target_user_id" value="" />
                                <input type="hidden" name="reply_to_id" id="chat_form_reply_to_id" value="" />
                                <input type="hidden" name="edit_message_id" id="chat_form_edit_message_id" value="" />
                                <input type="file" name="attachment" id="chat_file_input" class="d-none" accept="image/*,.pdf,.doc,.docx,.zip,.xls,.xlsx,.txt" />

                                <!--begin::Reply Preview Box-->
                                <div class="p-2 bg-light-info bg-opacity-75 rounded-3 border border-info border-dashed mb-2 d-none align-items-center justify-content-between shadow-xs" id="chat_reply_preview">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden text-start">
                                        <div id="chat_reply_thumb_wrapper" class="d-none rounded-2 overflow-hidden border border-gray-300 flex-shrink-0 shadow-xs" style="width: 36px; height: 36px;">
                                            <img id="chat_reply_thumb" src="" alt="Foto" class="w-100 h-100 object-fit-cover d-block" />
                                        </div>
                                        <i class="ki-duotone ki-arrow-left fs-3 text-info flex-shrink-0"><span class="path1"></span><span class="path2"></span></i>
                                        <div class="overflow-hidden">
                                            <div class="fs-8 fw-bold text-info" id="chat_reply_sender">Membalas Pengguna</div>
                                            <div class="fs-8 text-gray-700 text-truncate mw-250px mw-sm-350px" id="chat_reply_text">Pesan...</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-icon btn-active-light-danger flex-shrink-0 ms-2" id="chat_btn_cancel_reply" data-bs-toggle="tooltip" title="Batal Balas">
                                        <i class="ki-duotone ki-cross fs-4"><span class="path1"></span><span class="path2"></span></i>
                                    </button>
                                </div>
                                <!--end::Reply Preview Box-->

                                <!--begin::Edit Mode Box-->
                                <div class="p-2 bg-light-warning bg-opacity-75 rounded-3 border border-warning border-dashed mb-2 d-none d-flex align-items-center justify-content-between" id="chat_edit_preview">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden text-start">
                                        <i class="ki-duotone ki-pencil fs-3 text-warning flex-shrink-0"><span class="path1"></span><span class="path2"></span></i>
                                        <div class="overflow-hidden">
                                            <div class="fs-8 fw-bold text-warning">Mengedit Pesan</div>
                                            <div class="fs-8 text-gray-700 text-truncate mw-300px" id="chat_edit_original_text">Teks asli...</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-icon btn-active-light-danger flex-shrink-0 ms-2" id="chat_btn_cancel_edit" data-bs-toggle="tooltip" title="Batal Edit">
                                        <i class="ki-duotone ki-cross fs-4"><span class="path1"></span><span class="path2"></span></i>
                                    </button>
                                </div>
                                <!--end::Edit Mode Box-->

                                <!--begin::Attachment preview (if any)-->
                                <div class="p-3 bg-light-primary bg-opacity-50 rounded-3 border border-primary border-dashed mb-3 d-none align-items-center justify-content-between shadow-xs" id="chat_attachment_preview">
                                    <div class="d-flex align-items-center gap-3 overflow-hidden">
                                        <!-- Thumbnail Gambar -->
                                        <div id="chat_attachment_thumb_wrapper" class="d-none position-relative rounded-2 overflow-hidden border border-gray-300 flex-shrink-0 shadow-xs" style="width: 54px; height: 54px;">
                                            <img id="chat_attachment_thumb" src="" alt="Pratinjau Foto" class="w-100 h-100 object-fit-cover d-block" />
                                        </div>
                                        <!-- Ikon Dokumen Non-Gambar -->
                                        <div id="chat_attachment_file_icon" class="d-flex align-items-center justify-content-center bg-light-primary text-primary rounded-2 flex-shrink-0" style="width: 48px; height: 48px;">
                                            <i class="ki-duotone ki-file fs-2x text-primary"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!-- Info Detail File -->
                                        <div class="overflow-hidden text-start">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <span class="badge badge-light-primary fs-9 fw-bold" id="chat_attachment_badge">Foto / Gambar</span>
                                                <span class="fs-9 text-muted fw-semibold" id="chat_attachment_size">0 KB</span>
                                            </div>
                                            <div class="fs-8 fw-bold text-gray-900 text-truncate mw-200px mw-sm-300px" id="chat_attachment_filename">berkas.jpg</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-icon btn-active-light-danger flex-shrink-0 ms-2" id="chat_btn_remove_attachment" data-bs-toggle="tooltip" title="Hapus Lampiran">
                                        <i class="ki-duotone ki-cross fs-3"><span class="path1"></span><span class="path2"></span></i>
                                    </button>
                                </div>
                                <!--end::Attachment preview-->

                                <!--begin::Live Typing Indicator Bubble-->
                                <div class="p-2 px-3 bg-light-primary bg-opacity-75 rounded-pill mb-2 d-none align-items-center gap-2 shadow-xs w-fit-content" id="chat_typing_indicator" style="width: fit-content;">
                                    <span class="fs-8 fw-semibold text-primary" id="chat_typing_name">Pengguna sedang mengetik</span>
                                    <span class="d-inline-flex align-items-center gap-1">
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                    </span>
                                </div>
                                <!--end::Live Typing Indicator Bubble-->

                                <!--begin::Input-->
                                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input"
                                    id="chat_message_input" name="message" 
                                    placeholder="Ketik pesan Anda..."></textarea>
                                <!--end::Input-->

                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack position-relative">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                                            id="chat_btn_trigger_file" data-bs-toggle="tooltip" title="Lampirkan Dokumen/Foto">
                                            <i class="ki-duotone ki-paper-clip fs-3"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                                            id="chat_btn_trigger_emoji" data-bs-toggle="tooltip" title="Sisipkan Emoticon">
                                            <i class="ki-duotone ki-emoji-happy fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </button>
                                    </div>
                                    <!--end::Actions-->

                                    <!--begin::Emoji Picker Popover-->
                                    <div id="chat_emoji_picker_popover" class="chat-emoji-popover position-absolute d-none shadow-lg bg-body border border-gray-300 rounded-3 p-3 z-index-3" style="bottom: 100%; left: 0; margin-bottom: 10px; width: 340px; max-width: calc(100vw - 40px);">
                                        <div class="d-flex align-items-center justify-content-between pb-2 mb-2 border-bottom border-gray-200">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fs-8 fw-bolder text-gray-900">Emoticon & Emoji</span>
                                                <span class="badge badge-light-primary fs-9 fw-bold" id="chat_emoji_count_badge">400+</span>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-icon btn-active-light-danger w-22px h-22px rounded-circle" id="chat_btn_close_emoji_picker" title="Tutup">
                                                <i class="ki-duotone ki-cross fs-5"><span class="path1"></span><span class="path2"></span></i>
                                            </button>
                                        </div>

                                        <!-- Category Nav Tabs -->
                                        <div class="d-flex align-items-center gap-1 overflow-auto pb-1 mb-2 border-bottom border-gray-200 flex-nowrap" id="chat_emoji_category_tabs" style="scrollbar-width: none;">
                                            <button type="button" class="btn btn-xs btn-light-primary active emoji-cat-tab-btn py-1 px-2 fs-8" data-cat="all" title="Semua">Semua</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="faces" title="Wajah & Ekspresi">😀</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="hands" title="Gestur & Tubuh">👍</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="hearts" title="Hati & Cinta">❤️</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="food" title="Makanan & Minuman">🍕</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="nature" title="Hewan & Alam">🐶</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="objects" title="Objek & Aktivitas">🔥</button>
                                            <button type="button" class="btn btn-xs btn-light emoji-cat-tab-btn py-1 px-2 fs-7" data-cat="travel" title="Perjalanan & Tempat">🚀</button>
                                        </div>

                                        <!-- Emojis Grid Container -->
                                        <div id="chat_emoji_items_container" class="d-flex flex-wrap gap-1 fs-3 overflow-y-auto" style="max-height: 220px; user-select: none;"></div>
                                    </div>
                                    <!--end::Emoji Picker Popover-->

                                    <!--begin::Send-->
                                    <button class="btn btn-primary" type="button" id="chat_btn_send" data-kt-element="send">
                                        <span class="indicator-label" id="chat_btn_send_label">Send</span>
                                        <span class="indicator-progress">
                                            <span class="spinner-border spinner-border-sm align-middle"></span>
                                        </span>
                                    </button>
                                    <!--end::Send-->
                                </div>
                                <!--end::Toolbar-->
                            </form>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Messenger-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->

            <!--begin::Modals-->
            @include('partials.modals.kt_modal_view_users')
            @include('partials.modals.kt_modal_users_search')
            @include('partials.modals.kt_modal_invite_friends')
            @include('partials.modals.kt_modal_upgrade_plan')
            @include('partials.modals.kt_modal_create_app')

            <!--begin::Modal Profil Pengguna Publik-->
            @include('pages.dashboard.partials.modal-public-profile')
            <!--end::Modal Profil Pengguna Publik-->

            <!--begin::Modal Pratinjau Foto Chat-->
            @include('pages.profil.partials.modals.modal-chat-image-preview')
            <!--end::Modal Pratinjau Foto Chat-->

            <!--begin::Modal Teruskan Pesan Chat-->
            @include('pages.profil.partials.modals.modal-chat-forward')
            <!--end::Modal Teruskan Pesan Chat-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('js/widgets.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/widgets.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/upgrade-plan.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/create-app.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ \App\Support\ThemeAsset::url('js/custom/utilities/modals/users-search.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ asset('assets/js/custom/app-chat.js') }}?v={{ time() }}"></script>
    <!--end::Custom Javascript-->
@endsection
