# Aturan Standar UI: Responsif Navigasi Tab Modul (Mobile Icon-Only & Hover Tooltips)

## Scope & Trigger
Aturan ini **WAJIB** dipatuhi dalam pembuatan halaman/modul baru, perombakan antarmuka (UI), atau pengeditan komponen tab di seluruh modul proyek (`profil/*`, `appsupport/*`, `usermanagement/*`, `masterdata/*`, `apps/*`, `system/*`, dan semua modul lainnya).

---

## 1. Prinsip Utama: Tab Responsif Mobile (Icon-Only + Tooltip Hover)

Pada setiap deretan navigasi tab modul (`nav-tabs`, `nav-line-tabs`, `nav-pills`, `nav-stretch`):

1. **TAMPILAN MOBILE / SMARTPHONE (`< md`)**:
   - Teks label nama tab **WAJIB DISEMBUNYIKAN** pada layar mobile menggunakan utility class `d-none d-md-inline`.
   - Ikon tab **WAJIB TAMPIL JELAS** dengan ukuran responsif yang mudah disentuh (`fs-2 fs-md-4` atau `fs-3 fs-md-4`).
   - Margin kanan ikon diatur adaptif (`me-0 me-md-2`), sehingga tidak ada jarak spasi kosong berlebih saat teks disembunyikan.
   - Jarak antar tab dibuat proporsional (`me-3 me-md-8` atau `me-4 me-md-8`) dan container pembungkus navs menggunakan `overflow-auto flex-nowrap` agar scroll horizontal mulus tanpa wrap aneh.

2. **TOOLTIP INTERAKTIF HOVER (WAJIB)**:
   - Setiap elemen link/tab item **WAJIB DIBEKALI TOOLTIP BOOTSTRAP DENGAN TRIGGER HOVER**:
     ```html
     data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Nama Tab"
     ```
   - Saat pengguna di mobile menyentuh/meng-hover ikon tab, tooltip akan langsung memunculkan nama tab secara interaktif.

3. **TAMPILAN DESKTOP (`>= md`)**:
   - Pada layar desktop, teks nama tab tampil lengkap berdampingan secara harmonis dengan ikon tab.

---

## 2. Pola Standar Penulisan Blade / HTML Tab

```html
<!-- Container Navs (Didukung overflow-auto & flex-nowrap) -->
<div class="card-body py-0 px-4 px-lg-9 border-top border-gray-200 overflow-auto">
    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold flex-nowrap" role="tablist">
        <!-- Item Tab 1 -->
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'tab-1' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_tab_pane_1"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Profil Saya">
                <i class="ki-duotone ki-user fs-2 fs-md-4 me-0 me-md-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Profil Saya">
                    <span class="path1"></span><span class="path2"></span>
                </i>
                <span class="d-none d-md-inline">Profil Saya</span>
            </a>
        </li>

        <!-- Item Tab 2 -->
        <li class="nav-item mt-2" role="presentation">
            <a class="nav-link text-active-primary ms-0 me-4 me-md-8 py-5 {{ $currentTab === 'tab-2' ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" href="#kt_tab_pane_2"
                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Identitas Diri">
                <i class="ki-duotone ki-badge fs-2 fs-md-4 me-0 me-md-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Identitas Diri">
                    <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                </i>
                <span class="d-none d-md-inline">Identitas Diri</span>
            </a>
        </li>
    </ul>
</div>
```

---

## 3. Checklist Verifikasi Tab Responsif

- [ ] Label teks tab memiliki class `d-none d-md-inline`.
- [ ] Ikon tab memiliki ukuran adaptif `fs-2 fs-md-4` atau `fs-3 fs-md-4`.
- [ ] Ikon tab memiliki margin `me-0 me-md-2`.
- [ ] Tab memiliki atribut `data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="..."`.
- [ ] Container pembungkus tab memiliki `flex-nowrap` dan `overflow-auto` agar tidak terpotong di layar HP sempit.
