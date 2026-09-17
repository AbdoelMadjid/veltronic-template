"use strict";

/**
 * Helper Matrix CRUD Permission Table
 * Mengelola interaktivitas: Check All, Uncheck All, Row Check All, Search Filter,
 * serta Relasi Hirarki Otomatis (Hierarchical Parent-Child Permission Cascading)
 */
var KTCRUDMatrixHelper = function () {

    // 1. Pencarian Realtime Modul
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

    // 2. Tombol Pilih Semua & Kosongkan Global
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

    // 3. Hierarchical Cascading Engine (Level 1, 2, 3 Parent-Child Auto Check/Uncheck)
    var cascadeHierarchy = function (table, changedRow) {
        if (!table || !changedRow) return;

        var parentId = changedRow.getAttribute('data-parent-id');
        if (!parentId) return; // Sudah level 1, tidak ada parent di atasnya

        var parentRow = table.querySelector('tr[data-menu-id="' + parentId + '"]');
        if (!parentRow) return;

        // Kumpulkan semua descendant rows (anak dan cucu dari parent ini)
        var hasActiveChild = checkDescendantsActive(table, parentId);
        var parentReadCb = parentRow.querySelector('.matrix-perm-cb[data-action="read"]') || parentRow.querySelector('.matrix-perm-cb');

        if (hasActiveChild) {
            // Jika ada anak yang tercentang, otomatis centang Read pada Parent Menu
            if (parentReadCb && !parentReadCb.checked) {
                parentReadCb.checked = true;
            }
        } else {
            // Jika TIDAK ADA LAGI satupun anak yang tercentang, uncheck Read pada Parent Menu
            if (parentReadCb && parentReadCb.checked) {
                parentReadCb.checked = false;
            }
            var parentRowAll = parentRow.querySelector('.matrix-row-check-all');
            if (parentRowAll) {
                parentRowAll.checked = false;
            }
        }

        // Lanjutkan rekursif ke Level di atasnya (misal Level 3 -> Level 2 -> Level 1)
        cascadeHierarchy(table, parentRow);
    };

    // Helper memeriksa apakah ada setidaknya 1 checkbox anak/cucu yang tercentang di bawah parentId
    var checkDescendantsActive = function (table, parentId) {
        // Ambil semua baris anak langsung
        var directChildRows = table.querySelectorAll('tr[data-parent-id="' + parentId + '"]');
        for (var i = 0; i < directChildRows.length; i++) {
            var childRow = directChildRows[i];
            var childMenuId = childRow.getAttribute('data-menu-id');

            // Cek apakah ada checkbox tercentang di baris anak ini
            var checkedInRow = childRow.querySelectorAll('.matrix-perm-cb:checked');
            if (checkedInRow.length > 0) {
                return true;
            }

            // Jika anak ini punya sub-anak lagi (Level 3), cek rekursif
            if (childRow.getAttribute('data-has-children') === '1') {
                if (checkDescendantsActive(table, childMenuId)) {
                    return true;
                }
            }
        }
        return false;
    };

    // 4. Toggle Per Baris & Checkbox CRUD Individual
    var initRowCheckAll = function () {
        // Toggle SEMUA per baris
        document.querySelectorAll('.matrix-row-check-all').forEach(function (rowCb) {
            rowCb.addEventListener('change', function () {
                var rowId = this.getAttribute('data-target-row');
                var isChecked = this.checked;
                var table = this.closest('table');
                var row = document.getElementById(rowId);

                document.querySelectorAll('.row-perm-' + rowId + ':not([disabled])').forEach(function (cb) {
                    cb.checked = isChecked;
                });

                if (table && row) {
                    cascadeHierarchy(table, row);
                    syncRowCheckStates('#' + table.id);
                }
            });
        });

        // Individual Checkbox Change
        document.querySelectorAll('.matrix-perm-cb').forEach(function (cb) {
            cb.addEventListener('change', function () {
                var table = this.closest('table');
                var row = this.closest('tr');
                if (!table || !row) return;

                // Jalankan cascading parent-child
                cascadeHierarchy(table, row);

                // Sinkronkan status "SEMUA" di setiap baris
                syncRowCheckStates('#' + table.id);
            });
        });
    };

    // 5. Sinkronisasi Checkbox "SEMUA" per Baris
    var syncRowCheckStates = function (tableSelector) {
        var table = document.querySelector(tableSelector);
        if (!table) return;

        table.querySelectorAll('tbody tr.matrix-row').forEach(function (row) {
            var rowCheckAll = row.querySelector('.matrix-row-check-all');
            if (!rowCheckAll) return;

            var totalCbs = row.querySelectorAll('.matrix-perm-cb');
            var checkedCbs = row.querySelectorAll('.matrix-perm-cb:checked');

            rowCheckAll.checked = (totalCbs.length > 0 && totalCbs.length === checkedCbs.length);
        });
    };

    return {
        init: function () {
            initSearch();
            initCheckAllButtons();
            initRowCheckAll();
        },
        syncRowCheckStates: function (tableSelector) {
            syncRowCheckStates(tableSelector);
        },
        cascadeHierarchy: function (table, row) {
            cascadeHierarchy(table, row);
        }
    };
}();

// Auto init on DOM ready
KTUtil.onDOMContentLoaded(function () {
    KTCRUDMatrixHelper.init();
});
