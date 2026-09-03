<?php

namespace App\Models\AppSupport;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'array',
        'active' => 'boolean',
        'paths' => 'integer',
        'orders' => 'integer',
    ];

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'main_menu_id')->orderBy('orders', 'asc');
    }

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'main_menu_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permission', 'menu_id', 'permission_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getTitleKeyAttribute(): ?string
    {
        return $this->meta['title_key'] ?? null;
    }

    public function getTitleEnAttribute(): ?string
    {
        return $this->meta['title_en'] ?? null;
    }

    public function getAssignedRolesAttribute()
    {
        return $this->permissions->loadMissing('roles')->flatMap->roles->pluck('name')->unique()->values();
    }

    /**
     * Dapatkan semua menu terurut secara hierarkis (Kategori -> Main Menu -> Sub Menu)
     */
    public static function getOrderedTree(?string $categoryFilter = null)
    {
        $query = static::with(['subMenus', 'permissions', 'parentMenu']);
        if ($categoryFilter) {
            $query->where('category', $categoryFilter);
        }

        $all = $query->get();

        $customOrder = array_keys(config('menu_seeder.categories', []));
        $categories = $all->pluck('category')->filter()->unique()->values();

        if (!empty($customOrder)) {
            $preferredOrder = array_values(array_unique($customOrder));
            $categories = $categories->sort(function ($a, $b) use ($preferredOrder) {
                $ai = array_search($a, $preferredOrder, true);
                $bi = array_search($b, $preferredOrder, true);
                $ai = $ai === false ? PHP_INT_MAX : $ai;
                $bi = $bi === false ? PHP_INT_MAX : $bi;
                return $ai <=> $bi ?: strcmp((string) $a, (string) $b);
            })->values();
        } else {
            $categories = $categories->sort()->values();
        }

        $result = collect();

        $addChildren = function ($menus, $pool, &$result, $depth = 0) use (&$addChildren) {
            foreach ($menus as $menu) {
                $menu->depth = $depth;
                $result->push($menu);
                $children = $pool->where('main_menu_id', $menu->id)->sortBy('orders');
                if ($children->isNotEmpty()) {
                    $addChildren($children, $pool, $result, $depth + 1);
                }
            }
        };

        foreach ($categories as $category) {
            $catMenus = $all->where('category', $category);
            $mainMenus = $catMenus->whereNull('main_menu_id')->sortBy('orders');
            $addChildren($mainMenus, $catMenus, $result);

            $processedIds = $result->pluck('id')->all();
            $orphans = $catMenus->whereNotIn('id', $processedIds)->sortBy('orders');
            $addChildren($orphans, $catMenus, $result);
        }

        $processedIds = $result->pluck('id')->all();
        $remaining = $all->whereNotIn('id', $processedIds)->sortBy('orders');
        $addChildren($remaining, $all, $result);

        return $result;
    }
}
