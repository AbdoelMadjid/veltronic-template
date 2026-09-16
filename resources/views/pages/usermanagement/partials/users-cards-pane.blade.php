<!--begin::Tab pane: Card View-->
<div id="kt_project_users_card_pane" class="tab-pane fade show active">
    <!--begin::Row-->
    <div class="row g-6 g-xl-9" id="users_card_container">
        @include('pages.usermanagement.partials.users-cards-list', ['users' => $users])
    </div>
    <!--end::Row-->

    <!--begin::Pagination-->
    <div class="d-flex flex-stack flex-wrap pt-10" id="users_card_pagination">
        <div class="fs-6 fw-semibold text-gray-700" id="users_card_info">
            {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} / {{ $users->total() }} Pengguna
        </div>
        <div class="users-pagination-links">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <!--end::Pagination-->
</div>
<!--end::Tab pane: Card View-->
