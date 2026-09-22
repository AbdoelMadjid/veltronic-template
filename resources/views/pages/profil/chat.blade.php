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
            padding: 6px 10px;
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-gray-300);
            z-index: 1050;
        }
    </style>
@endsection

@section('toolbar')
    @component('layouts.partials._toolbar')
        @slot('li_1')
            Profil Pengguna
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
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
                    <!--begin::Contacts-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header pt-7" id="kt_chat_contacts_header">
                            <!--begin::Form-->
                            <form class="w-100 position-relative" autocomplete="off" onsubmit="return false;">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid px-13" id="chat_contact_search_input" name="search"
                                    value="" placeholder="Search by username or email..." />
                                <!--end::Input-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-5" id="kt_chat_contacts_body">
                            <!--begin::List-->
                            <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true"
                                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                                data-kt-scroll-offset="5px" id="chat_contacts_list">
                                <!-- Loading state -->
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
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10 min-w-0">
                    <!--begin::Messenger-->
                    <div class="card" id="kt_chat_messenger">
                        <!--begin::Card header-->
                        <div class="card-header" id="kt_chat_messenger_header">
                            <!--begin::Title-->
                            <div class="card-title">
                                <!--begin::User-->
                                <div class="d-flex align-items-center me-3">
                                    <div class="symbol symbol-40px symbol-circle me-3 cursor-pointer btn-view-public-profile" id="chat_header_avatar_container" data-user-id="" data-bs-toggle="tooltip" title="Lihat Profil">
                                        <span class="symbol-label bg-light-primary text-primary fs-4 fw-bolder shadow-xs border border-2 border-body symbol-circle">
                                            <i class="ki-duotone ki-messages fs-3 text-primary"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-center flex-column">
                                        <a href="javascript:void(0)"
                                            class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1 btn-view-public-profile" id="chat_header_user_name" data-user-id="" data-bs-toggle="tooltip" title="Lihat Profil">Ruang Obrolan</a>
                                        <!--begin::Info-->
                                        <div class="mb-0 lh-1">
                                            <span class="badge badge-success badge-circle w-10px h-10px me-1 d-none" id="chat_header_presence_dot"></span>
                                            <span class="fs-7 fw-semibold text-muted" id="chat_header_user_status">Pilih pengguna untuk mulai chat</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary btn-view-public-profile d-none" id="chat_btn_view_profile" data-user-id="" data-bs-toggle="tooltip" title="Lihat Profil">
                                    <i class="ki-duotone ki-user fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body" id="kt_chat_messenger_body">
                            <!--begin::Pinned Banner (if any)-->
                            <div class="p-3 bg-light-warning bg-opacity-75 rounded-3 border border-warning border-dashed mb-4 d-none align-items-center justify-content-between shadow-xs" id="chat_pinned_banner">
                                <div class="d-flex align-items-center gap-3 overflow-hidden cursor-pointer flex-grow-1" id="chat_pinned_jump_btn" title="Klik untuk melompat ke pesan yang disematkan">
                                    <i class="ki-duotone ki-pin fs-2 text-warning flex-shrink-0"><span class="path1"></span><span class="path2"></span></i>
                                    
                                    <!-- Thumbnail Foto Lampiran -->
                                    <div id="chat_pinned_thumb_wrapper" class="d-none rounded-2 overflow-hidden border border-gray-300 flex-shrink-0 shadow-xs" style="width: 38px; height: 38px; min-width: 38px;">
                                        <img id="chat_pinned_thumb" src="" alt="Foto" class="w-100 h-100 object-fit-cover d-block" />
                                    </div>
                                    <!-- Ikon File Non-Gambar -->
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
                            <div class="scroll-y me-n5 pe-5" data-kt-element="messages"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                data-kt-scroll-offset="5px" id="chat_messages_scroll">
                                <div id="chat_messages_thread" class="d-flex flex-column flex-grow-1">
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
                        <!--begin::Card footer-->
                        <div class="card-footer pt-4 mt-auto" id="kt_chat_messenger_footer">
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

                                <!--begin::Input-->
                                <textarea class="form-control form-control-flush mb-3" rows="1"
                                    id="chat_message_input" name="message" 
                                    placeholder="{{ empty($selectedUserId) ? 'Silakan pilih pengguna di panel sebelah kiri untuk mulai mengobrol...' : 'Ketik pesan Anda...' }}" 
                                    {{ empty($selectedUserId) ? 'disabled' : '' }} style="resize: none;"></textarea>
                                <!--end::Input-->

                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack position-relative">
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center me-2">
                                        <!--begin::Emoji Picker Trigger-->
                                        <div class="position-relative d-inline-block">
                                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                                                id="chat_btn_trigger_emoji" data-bs-toggle="tooltip" title="Sisipkan Emoticon" {{ empty($selectedUserId) ? 'disabled' : '' }}>
                                                <i class="ki-duotone ki-emoji-happy fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                            </button>
                                            <!--begin::Emoji Picker Dropdown Popover-->
                                            <div class="card card-flush shadow-lg border border-gray-200 position-absolute bottom-100 start-0 mb-2 p-3 d-none z-index-3 bg-body" id="chat_emoji_picker_popover" style="width: 280px;">
                                                <div class="d-flex align-items-center justify-content-between pb-2 border-bottom border-gray-100 mb-2">
                                                    <span class="fs-8 fw-bold text-gray-700">Pilih Emoticon</span>
                                                    <button type="button" class="btn btn-xs btn-icon btn-active-light-danger" id="chat_btn_close_emoji_picker">
                                                        <i class="ki-duotone ki-cross fs-6"><span class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                </div>
                                                <div class="d-flex flex-wrap gap-1 justify-content-start overflow-auto" style="max-height: 180px;" id="chat_emoji_items_container">
                                                    <!-- Emojis injected via JS -->
                                                </div>
                                            </div>
                                            <!--end::Emoji Picker Dropdown Popover-->
                                        </div>
                                        <!--end::Emoji Picker Trigger-->

                                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button"
                                            id="chat_btn_trigger_file" data-bs-toggle="tooltip" title="Lampirkan Gambar atau Berkas" {{ empty($selectedUserId) ? 'disabled' : '' }}>
                                            <i class="ki-duotone ki-paper-clip fs-3"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1 d-none d-sm-inline-flex" type="button"
                                            data-bs-toggle="tooltip" title="Kirim File Cepat" onclick="document.getElementById('chat_file_input').click();" {{ empty($selectedUserId) ? 'disabled' : '' }}>
                                            <i class="ki-duotone ki-exit-up fs-3"><span class="path1"></span><span class="path2"></span></i>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                    <!--begin::Send-->
                                    <button class="btn btn-primary" type="button" id="chat_btn_send" {{ empty($selectedUserId) ? 'disabled' : '' }}>
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
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->

    <!--begin::Modal Profil Pengguna Publik-->
    @include('pages.dashboard.partials.modal-public-profile')
    <!--end::Modal Profil Pengguna Publik-->

    <!--begin::Modal Pratinjau Foto Chat-->
    @include('pages.profil.partials.modals.modal-chat-image-preview')
    <!--end::Modal Pratinjau Foto Chat-->

    <!--begin::Modal Teruskan Pesan Chat-->
    @include('pages.profil.partials.modals.modal-chat-forward')
    <!--end::Modal Teruskan Pesan Chat-->
@endsection

@section('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ \App\Support\ThemeAsset::url('plugins/custom/datatables/datatables.bundle.js', $theme_asset_pack ?? null) }}"></script>
    <script src="{{ asset('assets/js/custom/app-chat.js') }}"></script>
    <!--end::Vendors Javascript-->
@endsection
