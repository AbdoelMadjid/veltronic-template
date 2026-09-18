<?php

namespace App\Models\AppSupport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppShortcut extends Model
{
    use HasFactory;

    protected $table = 'app_shortcuts';

    protected $fillable = [
        'name',
        'key',
        'ctrl',
        'alt',
        'shift',
        'meta',
        'action_type',
        'action_target',
        'roles',
        'description',
        'is_enabled',
        'order',
    ];

    protected $casts = [
        'ctrl' => 'boolean',
        'alt' => 'boolean',
        'shift' => 'boolean',
        'meta' => 'boolean',
        'roles' => 'array',
        'is_enabled' => 'boolean',
        'order' => 'integer',
    ];

    const CACHE_KEY = 'app_active_shortcuts_list';

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function () {
            Cache::forget(self::CACHE_KEY);
        });
    }

    /**
     * Categories definition with metadata
     */
    const CATEGORIES = [
        'visibility' => [
            'name' => 'Toggle Visibilitas',
            'icon' => 'ki-eye',
            'color' => 'primary',
            'badge_class' => 'badge-light-primary',
            'types' => ['toggle_sidebar_menus', 'toggle_topbar_tools', 'toggle_topbar_menus', 'visibility_toggle'],
        ],
        'navigation' => [
            'name' => 'Navigasi Menu',
            'icon' => 'ki-route',
            'color' => 'info',
            'badge_class' => 'badge-light-info',
            'types' => ['open_url', 'nav_link'],
        ],
        'appearance' => [
            'name' => 'Tema & Tampilan',
            'icon' => 'ki-color-filter',
            'color' => 'success',
            'badge_class' => 'badge-light-success',
            'types' => ['icon_style', 'theme_mode', 'switch_language', 'switch_version', 'appearance'],
        ],
        'system' => [
            'name' => 'Aksi Sistem',
            'icon' => 'ki-shield-tick',
            'color' => 'danger',
            'badge_class' => 'badge-light-danger',
            'types' => ['search', 'lock_screen', 'system_action'],
        ],
        'element' => [
            'name' => 'Klik Elemen',
            'icon' => 'ki-cursor',
            'color' => 'warning',
            'badge_class' => 'badge-light-warning',
            'types' => ['click_element'],
        ],
    ];

    /**
     * Get shortcut category key (visibility, navigation, appearance, system, element)
     */
    public function getCategoryAttribute(): string
    {
        foreach (self::CATEGORIES as $key => $meta) {
            if (in_array($this->action_type, $meta['types'])) {
                return $key;
            }
        }
        return 'navigation';
    }

    /**
     * Get category metadata array
     */
    public function getCategoryMetaAttribute(): array
    {
        $cat = $this->category;
        return self::CATEGORIES[$cat] ?? self::CATEGORIES['navigation'];
    }

    /**
     * Formatted string of key combination (e.g. "Ctrl + M" or "Ctrl + Shift + L")
     */
    public function getFormattedCombinationAttribute(): string
    {
        $parts = [];
        if ($this->ctrl) $parts[] = 'Ctrl';
        if ($this->alt) $parts[] = 'Alt';
        if ($this->shift) $parts[] = 'Shift';
        if ($this->meta) $parts[] = 'Win/Cmd';

        $mainKey = strtoupper($this->key);
        if ($this->key === '/') $mainKey = '/';
        $parts[] = $mainKey;

        return implode(' + ', $parts);
    }

    /**
     * macOS formatted combination (e.g. "⌘ + M" or "⌘ + ⇧ + L")
     */
    public function getMacCombinationAttribute(): string
    {
        $parts = [];
        if ($this->ctrl) $parts[] = '⌘';
        if ($this->alt) $parts[] = '⌥';
        if ($this->shift) $parts[] = '⇧';
        if ($this->meta) $parts[] = '⌃';

        $mainKey = strtoupper($this->key);
        if ($this->key === '/') $mainKey = '/';
        $parts[] = $mainKey;

        return implode(' + ', $parts);
    }

    /**
     * Check if this shortcut is allowed for a specific user.
     */
    public function isAllowedForUser($user = null): bool
    {
        if (empty($this->roles)) {
            return true; // Available for all users/roles
        }

        if (!$user) {
            $user = auth()->user();
        }

        if (!$user) {
            return false;
        }

        // Master role always has full access
        if (method_exists($user, 'isMaster') && $user->isMaster()) {
            return true;
        }

        $userRoles = [];
        if (method_exists($user, 'getRoleNames')) {
            $userRoles = $user->getRoleNames()->toArray();
        } elseif (isset($user->roles)) {
            $userRoles = $user->roles->pluck('name')->toArray();
        } elseif (!empty($user->role)) {
            $userRoles = [$user->role];
        }

        $allowedRoles = is_array($this->roles) ? $this->roles : [];

        foreach ($allowedRoles as $role) {
            if (in_array(strtolower(trim($role)), array_map('strtolower', $userRoles))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all shortcuts allowed for active user.
     */
    public static function getActiveForCurrentUser()
    {
        $user = auth()->user();
        $all = self::where('is_enabled', true)->orderBy('order')->get();

        return $all->filter(function ($shortcut) use ($user) {
            return $shortcut->isAllowedForUser($user);
        })->values();
    }
}
