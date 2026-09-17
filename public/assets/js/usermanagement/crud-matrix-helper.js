"use strict";

/**
 * Helper Matrix CRUD Permission Table
 * Mengelola interaktivitas: Check All, Uncheck All, Row Check All, Search Filter
 */
var KTCRUDMatrixHelper = function () {

    var initSearch = function () {
        document.querySelectorAll('.matrix-search-input').forEach(function (input) {
            input.addEventListener('keyup', function (e) {
                var query = e.target.value.toLowerCase().trim();
                var tableId = input.getAttribute('data-target');
                var table = document.querySelector(tableId);
                if (!table) return;

                var rows = table.querySelectorAll('tbody tr.matrix-row');
                var matchedParents = {};

                // Cek baris anak dan induk
                rows.forEach(function (row) {
                    var modName = (row.getAttribute('data-module-name') || '').toLowerCase();
                    var modUrl = (row.getAttribute('data-module-url') || '').toLowerCase();
                    var parentName = (row.getAttribute('data-parent-name') || '').toLowerCase();

                    var isMatch = (modName.indexOf(query) > -1 || modUrl.indexOf(query) > -1 || parentName.indexOf(query) > -1);

                    if (isMatch || query === '') {
                        row.style.display = '';
                        if (parentName) {
                            matchedParents[parentName] = true;
                        }
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Pastikan parent row tetap tampil jika child row-nya match
                if (query !== '') {
                    rows.forEach(function (row) {
                        if (row.classList.contains('matrix-parent-row')) {
                            var modName = (row.getAttribute('data-module-name') || '').toLowerCase();
                            if (matchedParents[modName]) {
                                row.style.display = '';
                            }
                        }
                    });
                }
            });
        });
    };

    var initCheckAllButtons = function () {
        // Pilih Semua
        document.querySelectorAll('.btn-matrix-check-all').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('data-target'));
                if (!target) return;

                target.querySelectorAll('.matrix-perm-cb:not([disabled])').forEach(function (cb) {
                    cb.checked = true;
                });
                target.querySelectorAll('.matrix-row-check-all:not([disabled])').forEach(function (cb) {
                    cb.checked = true;
                });
            });
        });

        // Kosongkan
        document.querySelectorAll('.btn-matrix-uncheck-all').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var target = document.querySelector(this.getAttribute('data-target'));
                if (!target) return;

                target.querySelectorAll('.matrix-perm-cb:not([disabled])').forEach(function (cb) {
                    cb.checked = false;
                });
                target.querySelectorAll('.matrix-row-check-all:not([disabled])').forEach(function (cb) {
                    cb.checked = false;
                });
            });
        });
    };

    var initRowCheckAll = function () {
        // Toggle SEMUA per baris
        document.querySelectorAll('.matrix-row-check-all').forEach(function (rowCb) {
            rowCb.addEventListener('change', function () {
                var rowId = this.getAttribute('data-target-row');
                var isChecked = this.checked;

                document.querySelectorAll('.row-perm-' + rowId + ':not([disabled])').forEach(function (cb) {
                    cb.checked = isChecked;
                });
            });
        });

        // Update SEMUA checkbox jika child checkbox berubah
        document.querySelectorAll('.matrix-perm-cb').forEach(function (cb) {
            cb.addEventListener('change', function () {
                var row = this.closest('tr');
                if (!row) return;

                var rowId = row.id;
                var rowCheckAll = row.querySelector('.matrix-row-check-all');
                if (!rowCheckAll) return;

                var totalCbs = row.querySelectorAll('.matrix-perm-cb');
                var checkedCbs = row.querySelectorAll('.matrix-perm-cb:checked');

                rowCheckAll.checked = (totalCbs.length > 0 && totalCbs.length === checkedCbs.length);
            });
        });
    };

    return {
        init: function () {
            initSearch();
            initCheckAllButtons();
            initRowCheckAll();
        },
        syncRowCheckStates: function (tableSelector) {
            var table = document.querySelector(tableSelector);
            if (!table) return;

            table.querySelectorAll('tbody tr.matrix-row').forEach(function (row) {
                var rowCheckAll = row.querySelector('.matrix-row-check-all');
                if (!rowCheckAll) return;

                var totalCbs = row.querySelectorAll('.matrix-perm-cb');
                var checkedCbs = row.querySelectorAll('.matrix-perm-cb:checked');

                rowCheckAll.checked = (totalCbs.length > 0 && totalCbs.length === checkedCbs.length);
            });
        }
    };
}();

// Auto init on DOM ready
KTUtil.onDOMContentLoaded(function () {
    KTCRUDMatrixHelper.init();
});
