<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

if (!function_exists('role_label')) {
    function role_label(?string $roleName): ?string
    {
        if (!filled($roleName)) {
            return null;
        }

        $displayNames = [
            'master' => 'Master',
            'admin' => 'Administrator',
            'kepsek' => 'Kepala Sekolah',
            'guru' => 'Tenaga Pendidik',
            'tatausaha' => 'Tenaga Kependidikan',
            'wakasek' => 'Wakil Kepala Sekolah',
            'kaprog' => 'Ketua Program Studi',
            'gmapel' => 'Guru Mata Pelajaran',
            'walas' => 'Wali Kelas',
            'siswa' => 'Peserta Didik',
            'tamu' => 'Pengunjung',
            'pembpkl' => 'Pembimbing PKL',
            'adminpkl' => 'Administrator PKL',
            'pesertapkl' => 'Peserta PKL',
            'kaprodiak' => 'Kaprodi AK',
            'kaprodibd' => 'Kaprodi BD',
            'kaprodimp' => 'Kaprodi MP',
            'kaprodirpl' => 'Kaprodi RPL',
            'kaproditkj' => 'Kaprodi TKJ',
            'bpbk' => 'Bimbingan Konseling',
            'alumni' => 'Alumni',
            'panitiapkl' => 'Panitia PKL',
            'kaprakerinak' => 'Panitia Prakerin AK',
            'kaprakerinbd' => 'Panitia Prakerin BD',
            'kaprakerinmp' => 'Panitia Prakerin MP',
            'kaprakerinrpl' => 'Panitia Prakerin RPL',
            'kaprakerintkj' => 'Panitia Prakerin TKJ',
            'guruprakerin' => 'Guru Pembimbing PKL',
            'siswaprakerin' => 'Siswa Peserta PKL',
            'guruwali' => 'Guru Wali',
            'adminps' => 'Pengembang Sekolah',
        ];

        return $displayNames[$roleName] ?? $roleName;
    }
}

if (!function_exists('getRoleName')) {
    function getRoleName()
    {
        $user = Auth::user();

        if ($user && $user->roles->isNotEmpty()) {
            $roleName = $user->roles->first()->name;
            return role_label($roleName);
        }

        return null;
    }
}

if (!function_exists('user_role_labels')) {
    function user_role_labels($user = null, string $separator = ', '): string|HtmlString
    {
        $user ??= Auth::user();

        if (!$user) {
            return '';
        }

        $roleNames = method_exists($user, 'getRoleNames')
            ? $user->getRoleNames()
            : (data_get($user, 'roles')?->pluck('name') ?? collect());

        $labels = collect($roleNames)
            ->filter(fn($name) => filled($name))
            ->map(fn($name) => role_label((string) $name))
            ->filter(fn($label) => filled($label))
            ->unique();

        $separatorKey = Str::of($separator)->lower()->trim()->toString();

        // Convenience: allow "br" to render as HTML line breaks safely.
        if (in_array($separatorKey, ['br', '<br>', '<br/>', '<br />', 'linebreak', 'break'], true)) {
            return new HtmlString(
                $labels
                    ->map(fn($label) => e((string) $label))
                    ->implode('<br>')
            );
        }

        return $labels->implode($separator);
    }
}



if (!function_exists('renderGreeting')) {
    function renderGreeting(?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        $date = Carbon::now('Asia/Jakarta');
        $hour = $date->hour;

        if ($hour >= 0 && $hour < 12) {
            $idText = 'Selamat Pagi';
            $enText = 'Good Morning';
        } elseif ($hour >= 12 && $hour < 15) {
            $idText = 'Selamat Siang';
            $enText = 'Good Afternoon';
        } elseif ($hour >= 15 && $hour < 18) {
            $idText = 'Selamat Sore';
            $enText = 'Good Evening';
        } else {
            $idText = 'Selamat Malam';
            $enText = 'Good Night';
        }

        $currentText = $locale === 'en' ? $enText : $idText;

        return "<span id='greeting-display' data-kt-lang-id=\"{$idText}\" data-kt-lang-en=\"{$enText}\">{$currentText}</span>";
    }
}

if (!function_exists('renderDate')) {
    function renderDate(array $options = [], ?string $locale = null)
    {
        $defaults = [
            'wrapper_id' => 'date-display',
            'wrapper_class' => '',
            'day_class' => '',
            'sunday_class' => 'text-danger',
            'sunday_style' => '',
            'friday_class' => '',
            'friday_style' => 'color:#1f9d81; font-weight:700;',
            'override_day_colors' => false,
        ];
        $opts = array_merge($defaults, $options);

        $locale = $locale ?: app()->getLocale();
        $date = Carbon::now('Asia/Jakarta');

        $buildDateString = static function (string $loc) use ($date, $opts) {
            $dateLoc = (clone $date)->locale($loc);
            $day = $dateLoc->translatedFormat('l');

            $dayClass = trim($opts['day_class']);
            $dayStyle = '';
            if (!$opts['override_day_colors']) {
                if ($dateLoc->dayOfWeek === Carbon::SUNDAY) {
                    $dayClass = trim($dayClass . ' ' . $opts['sunday_class']);
                    $dayStyle = $opts['sunday_style'];
                } elseif ($dateLoc->dayOfWeek === Carbon::FRIDAY) {
                    $dayClass = trim($dayClass . ' ' . $opts['friday_class']);
                    $dayStyle = $opts['friday_style'];
                }
            }

            $dayAttrs = '';
            if ($dayClass !== '') {
                $dayAttrs .= " class='{$dayClass}'";
            }
            if ($dayStyle !== '') {
                $dayAttrs .= " style='{$dayStyle}'";
            }
            $dayHtml = $dayAttrs !== '' ? "<span{$dayAttrs}>$day</span>" : $day;

            $formattedDate = $dateLoc->translatedFormat('j F Y');
            $hijriDate = toHijriah($dateLoc, $loc);

            $gregorianSuffix = __('translation.gregorian_suffix', [], $loc);
            if ($gregorianSuffix === 'translation.gregorian_suffix') {
                $gregorianSuffix = $loc === 'en' ? 'AD' : 'M';
            }

            return "{$dayHtml}, {$formattedDate} {$gregorianSuffix} ( {$hijriDate} )";
        };

        $contentId = $buildDateString('id');
        $contentEn = $buildDateString('en');
        $currentContent = $locale === 'en' ? $contentEn : $contentId;

        $wrapperAttrs = "id='{$opts['wrapper_id']}'";
        if ($opts['wrapper_class'] !== '') {
            $wrapperAttrs .= " class='{$opts['wrapper_class']}'";
        }

        $attrId = htmlspecialchars($contentId, ENT_QUOTES, 'UTF-8');
        $attrEn = htmlspecialchars($contentEn, ENT_QUOTES, 'UTF-8');

        return "<span {$wrapperAttrs} data-kt-lang-id=\"{$attrId}\" data-kt-lang-en=\"{$attrEn}\">{$currentContent}</span>";
    }
}

if (!function_exists('renderTime')) {
    function renderTime($id = 'time-display')
    {
        $date = Carbon::now('Asia/Jakarta');
        $formattedTime = $date->format('H:i:s');

        // Return the initial time display with JavaScript to update it dynamically
        return "<span id='$id'>$formattedTime</span>
                <script>
                    function startClock(id) {
                        let timeDisplay = document.getElementById(id);

                        function updateTime() {
                            const now = new Date();
                            let hours = now.getHours();
                            let minutes = now.getMinutes();
                            let seconds = now.getSeconds();

                            // Format time as 24-hour clock
                            hours = hours < 10 ? '0' + hours : hours;
                            minutes = minutes < 10 ? '0' + minutes : minutes;
                            seconds = seconds < 10 ? '0' + seconds : seconds;

                            // Update the time display
                            timeDisplay.textContent = hours + ':' + minutes + ':' + seconds;
                        }

                        updateTime(); // Initial call to set the time immediately
                        setInterval(updateTime, 1000); // Update time every second
                    }

                    startClock('$id');
                </script>";
    }
}


if (!function_exists('toHijriah')) {
    function toHijriah($date = null, ?string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        if (is_null($date)) {
            $date = Carbon::now('Asia/Jakarta');
        } elseif (!$date instanceof Carbon) {
            $date = Carbon::parse($date, 'Asia/Jakarta');
        }

        $monthsId = [
            1 => 'Muharram',
            2 => 'Safar',
            3 => 'Rabiul Awwal',
            4 => 'Rabiul Akhir',
            5 => 'Jumadil Awwal',
            6 => 'Jumadil Akhir',
            7 => 'Rajab',
            8 => "Sya'ban",
            9 => 'Ramadhan',
            10 => 'Syawwal',
            11 => 'Zulqaidah',
            12 => 'Zulhijjah',
        ];

        $monthsEn = [
            1 => 'Muharram',
            2 => 'Safar',
            3 => "Rabi' al-Awwal",
            4 => "Rabi' al-Thani",
            5 => 'Jumada al-Awwal',
            6 => 'Jumada al-Thani',
            7 => 'Rajab',
            8 => "Sha'ban",
            9 => 'Ramadan',
            10 => 'Shawwal',
            11 => "Dhu al-Qi'dah",
            12 => 'Dhu al-Hijjah',
        ];

        $translatedMonths = __('translation.hijri_months', [], $locale);
        if (is_array($translatedMonths)) {
            $months = $translatedMonths;
        } else {
            $months = $locale === 'en' ? $monthsEn : $monthsId;
        }

        $suffix = __('translation.hijri_suffix', [], $locale);
        if ($suffix === 'translation.hijri_suffix') {
            $suffix = $locale === 'en' ? 'AH' : 'H';
        }

        $day = $date->day;
        $month = $date->month;
        $year = $date->year;

        // Julian Day calculation
        if (($year > 1582) || (($year == 1582) && ($month > 10)) || (($year == 1582) && ($month == 10) && ($day > 14))) {
            $jd = intval((1461 * ($year + 4800 + intval(($month - 14) / 12))) / 4) +
                intval((367 * ($month - 2 - 12 * (intval(($month - 14) / 12)))) / 12) -
                intval((3 * (intval(($year + 4900 + intval(($month - 14) / 12)) / 100))) / 4) +
                $day - 32075;
        } else {
            $jd = 367 * $year - intval((7 * ($year + 5001 + intval(($month - 9) / 7))) / 4) +
                intval((275 * $month) / 9) + $day + 1729777;
        }

        // Hijri date calculation
        $l = $jd - 1948440 + 10632;
        $n = intval(($l - 1) / 10631);
        $l = $l - 10631 * $n + 354;
        $z = (intval((10985 - $l) / 5316)) * (intval((50 * $l) / 17719)) + (intval($l / 5670)) * (intval((43 * $l) / 15238));
        $l = $l - (intval((30 - $z) / 15)) * (intval((17719 * $z) / 50)) - (intval($z / 16)) * (intval((15238 * $z) / 43)) + 29;
        $m = intval((24 * $l) / 709);
        $d = $l - intval((709 * $m) / 24);
        $y = 30 * $n + $z - 30;
        $monthNumber = $m;

        $monthName = $months[$monthNumber] ?? ($monthsId[$monthNumber] ?? '');

        return "{$d} {$monthName} {$y} {$suffix}";
    }
}



function generateRandomText($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomText = '';

    for ($i = 0; $i < $length; $i++) {
        $randomText .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomText;
}

if (!function_exists('warnaDariId')) {
    function warnaDariId($id)
    {
        $hash = crc32($id);
        $hex = substr(dechex($hash), 0, 6);
        return '#' . str_pad($hex, 6, '0', STR_PAD_RIGHT);
    }
}

if (!function_exists('kontrasTeks')) {
    function kontrasTeks($bg)
    {
        $r = hexdec(substr($bg, 1, 2));
        $g = hexdec(substr($bg, 3, 2));
        $b = hexdec(substr($bg, 5, 2));
        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
        return $luminance > 0.5 ? '#000' : '#fff';
    }
}

if (!function_exists('forget_identitas_sekolah_cache')) {
    function forget_identitas_sekolah_cache(): void
    {
        cache()->forget('identitas_sekolah');
    }
}

// tampilkan user avatar yang login
if (!function_exists('user_avatar_url')) {

    function user_avatar_url($user = null, string $fallback = 'assets/images/users/avatar-1.jpg'): string
    {
        $user ??= Auth::user();

        $assetIfExists = static function (string $relativePath): ?string {
            $relativePath = ltrim(trim($relativePath), '/');

            if ($relativePath === '') {
                return null;
            }

            return file_exists(public_path($relativePath))
                ? asset($relativePath)
                : null;
        };

        if (!$user) {
            return asset($fallback);
        }

        $roleBasedFallback = static function ($user) use ($assetIfExists, $fallback): string {
            $isSiswaOrAlumni = $user->hasAnyRole(['siswa', 'alumni']) || !empty($user->nis);

            if ($isSiswaOrAlumni) {
                $gender = optional(
                    \App\Models\ManajemenSekolah\Personil\PesertaDidik::where('nis', $user->nis)->first()
                )->jenis_kelamin;
                $isFemale = Str::lower((string) $gender) === 'perempuan';

                return $assetIfExists($isFemale
                    ? 'images/siswacewek.png'
                    : 'images/siswacowok.png') ?? asset($fallback);
            }

            $personilRoles = ['kepsek', 'guru', 'tatausaha', 'wakasek', 'admin', 'master', 'kaprog', 'gmapel', 'walas', 'bpbk', 'guruprakerin'];
            $isPersonil = $user->hasAnyRole($personilRoles) || !empty($user->personal_id) || !empty(data_get($user, 'id_personil'));

            if ($isPersonil) {
                $personilId = $user->personal_id ?? data_get($user, 'id_personil');

                $gender = optional(
                    \App\Models\ManajemenSekolah\Personil\PersonilSekolah::where('id_personil', $personilId)->first()
                )->jeniskelamin;
                $isFemale = Str::lower((string) $gender) === 'perempuan';

                return $assetIfExists($isFemale
                    ? 'images/gurucewek.png'
                    : 'images/gurulaki.png') ?? asset($fallback);
            }

            return $assetIfExists($fallback) ?? asset($fallback);
        };

        $avatar = trim((string) $user->avatar);

        // Jika avatar ada
        if ($avatar !== '') {

            if (Str::startsWith($avatar, ['http://', 'https://', '//'])) {
                return $avatar;
            }

            if (Str::startsWith($avatar, '/')) {
                return $assetIfExists($avatar) ?? $roleBasedFallback($user);
            }

            if (Str::contains($avatar, '/')) {
                return $assetIfExists($avatar) ?? $roleBasedFallback($user);
            }

            if ($user->hasAnyRole(['siswa', 'alumni'])) {
                return $assetIfExists('images/peserta_didik/' . $avatar)
                    ?? ($assetIfExists('images/users/' . $avatar) ?? $roleBasedFallback($user));
            }

            return $assetIfExists('images/users/' . $avatar) ?? $roleBasedFallback($user);
        }

        return $roleBasedFallback($user);
    }
}

// ================================================== tampilkan avatar
if (!function_exists('avatar_personil_login')) {

    function avatar_personil_login($user): string
    {
        $avatar = trim((string) $user->avatar);

        $assetIfExists = function ($path) {
            $path = ltrim($path, '/');
            return file_exists(public_path($path)) ? asset($path) : null;
        };

        // ================= CEK AVATAR =================
        if ($avatar !== '') {

            // URL external
            if (
                str_starts_with($avatar, 'http://') ||
                str_starts_with($avatar, 'https://') ||
                str_starts_with($avatar, '//')
            ) {
                return $avatar;
            }

            // path langsung
            if (str_contains($avatar, '/')) {
                return $assetIfExists($avatar)
                    ?? fallback_user_gender($user, $assetIfExists);
            }

            // ================= CEK BERDASARKAN ROLE =================

            // 👉 SISWA → folder peserta_didik
            if (!empty($user->nis)) {
                return $assetIfExists('images/peserta_didik/' . $avatar)
                    ?? fallback_user_gender($user, $assetIfExists);
            }

            // 👉 GURU / PERSONIL → folder users
            if (!empty($user->personal_id)) {
                return $assetIfExists('images/users/' . $avatar)
                    ?? fallback_user_gender($user, $assetIfExists);
            }

            // fallback umum
            return fallback_user_gender($user, $assetIfExists);
        }

        // jika kosong
        return fallback_user_gender($user, $assetIfExists);
    }
}

if (!function_exists('fallback_user_gender')) {

    function fallback_user_gender($user, $assetIfExists): string
    {
        // ================= SISWA =================
        if (!empty($user->nis)) {

            $gender = strtolower((string) optional($user->siswa)->jenis_kelamin);

            return $assetIfExists(
                $gender === 'perempuan'
                    ? 'images/siswacewek.png'
                    : 'images/siswacowok.png'
            ) ?? asset('images/user-dummy-img.jpg');
        }

        // ================= PERSONIL / GURU =================
        if (!empty($user->personal_id)) {

            $gender = strtolower((string) optional($user->personil)->jeniskelamin);

            return $assetIfExists(
                $gender === 'perempuan'
                    ? 'images/gurucewek.png'
                    : 'images/gurulaki.png'
            ) ?? asset('images/user-dummy-img.jpg');
        }

        // ================= FALLBACK UMUM =================
        return asset('images/user-dummy-img.jpg');
    }
}

// mempersingkat nama user
if (!function_exists('format_nama_singkat')) {

    function format_nama_singkat($nama): string
    {
        $nama = trim($nama);

        if ($nama === '') {
            return '';
        }

        $words = preg_split('/\s+/', $nama);
        $count = count($words);

        // <= 2 kata → tampilkan semua
        if ($count <= 2) {
            return $nama;
        }

        // 3 kata → kata terakhir jadi inisial
        if ($count === 3) {
            return $words[0] . ' ' . $words[1] . ' ' . strtoupper(substr($words[2], 0, 1)) . '.';
        }

        // >= 4 kata → 2 kata terakhir jadi inisial
        return $words[0] . ' ' . $words[1] . ' ' .
            strtoupper(substr($words[2], 0, 1)) . '. ' .
            strtoupper(substr($words[3], 0, 1)) . '.';
    }
}

if (!function_exists('default_password_for_user')) {
    function default_password_for_user(?User $user): ?string
    {
        if (!$user) {
            return null;
        }

        return $user->hasAnyRole(['siswa']) ? 'siswaSKAONE30' : 'Siliwangi30';
    }
}

if (!function_exists('default_password_label_for_user')) {
    function default_password_label_for_user(?User $user): string
    {
        if (!$user) {
            return 'Default password';
        }

        return $user->hasAnyRole(['siswa']) ? 'Default siswa' : 'Default guru/personil';
    }
}

if (!function_exists('has_default_password')) {
    function has_default_password(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return Hash::check('Siliwangi30', $user->password)
            || Hash::check('siswaSKAONE30', $user->password);
    }
}
