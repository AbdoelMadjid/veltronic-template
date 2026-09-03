<?php

namespace App\Http\Controllers\AppSupport;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppSupport\MenuRequest;
use App\Models\AppSupport\Menu;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    /**
     * Display a listing of menus.
     */
    public function index(Request $request)
    {
        $categoryFilter = $request->query('category');
        $search = $request->query('search');

        $menus = Menu::getOrderedTree($categoryFilter);

        if ($search) {
            $menus = $menus->filter(function ($item) use ($search) {
                return str_contains(strtolower($item->name), strtolower($search)) ||
                       str_contains(strtolower($item->url), strtolower($search)) ||
                       str_contains(strtolower($item->title_key ?? ''), strtolower($search)) ||
                       str_contains(strtolower($item->title_en ?? ''), strtolower($search)) ||
                       str_contains(strtolower($item->category ?? ''), strtolower($search));
            })->values();
        }

        $categories = Menu::query()->pluck('category')->filter()->unique()->values()->all();
        $parentOptions = Menu::getOrderedTree();
        $level1Menus = Menu::query()->whereNull('main_menu_id')->with(['subMenus.subMenus'])->orderBy('orders')->get();
        $availablePermissions = Permission::query()->orderBy('name')->get(['id', 'name']);
        $roles = Role::query()->orderBy('name')->pluck('name')->all();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $menus,
            ]);
        }

        return view('pages.appsupport.menu', compact(
            'menus',
            'categories',
            'parentOptions',
            'level1Menus',
            'availablePermissions',
            'roles',
            'categoryFilter',
            'search'
        ));
    }

    /**
     * Store a newly created menu.
     */
    public function store(MenuRequest $request)
    {
        $validated = $request->validated();
        $permissions = $request->input('permissions', []);
        $roles = $request->input('roles', []);

        $meta = $validated['meta'] ?? [];
        if ($request->filled('title_key')) {
            $meta['title_key'] = trim($request->input('title_key'));
        }
        if ($request->filled('title_en')) {
            $meta['title_en'] = trim($request->input('title_en'));
        }

        DB::beginTransaction();
        try {
            $menu = Menu::create([
                'name' => $validated['name'],
                'url' => $validated['url'],
                'category' => $validated['category'] ?? null,
                'icon' => $validated['icon'] ?? null,
                'paths' => $validated['paths'] ?? null,
                'meta' => !empty($meta) ? $meta : null,
                'active' => $request->boolean('active', true),
                'orders' => $validated['orders'] ?? 0,
                'main_menu_id' => $validated['main_menu_id'] ?? null,
            ]);

            $this->syncPermissions($menu, $permissions, $validated['url'], $roles);
            $this->syncTranslations($meta['title_key'] ?? null, $validated['name'], $meta['title_en'] ?? null);

            // 2. Simpan Sub Menus (Level 2) jika ada
            if ($request->filled('sub_menus') && is_array($request->input('sub_menus'))) {
                foreach ($request->input('sub_menus') as $idx => $subData) {
                    if (empty($subData['name']) || empty($subData['url'])) {
                        continue;
                    }

                    $subMeta = [];
                    if (!empty($subData['title_key'])) {
                        $subMeta['title_key'] = trim($subData['title_key']);
                    }
                    if (!empty($subData['title_en'])) {
                        $subMeta['title_en'] = trim($subData['title_en']);
                    }

                    $subMenu = Menu::create([
                        'name' => $subData['name'],
                        'url' => $subData['url'],
                        'category' => $validated['category'] ?? null,
                        'icon' => $subData['icon'] ?? null,
                        'paths' => isset($subData['paths']) ? (int)$subData['paths'] : null,
                        'meta' => !empty($subMeta) ? $subMeta : null,
                        'active' => true,
                        'orders' => isset($subData['orders']) ? (int)$subData['orders'] : ($idx + 1),
                        'main_menu_id' => $menu->id,
                    ]);

                    $subPermissions = $subData['permissions'] ?? ['read'];
                    $this->syncPermissions($subMenu, $subPermissions, $subData['url'], $roles);
                    $this->syncTranslations($subMeta['title_key'] ?? null, $subData['name'], $subMeta['title_en'] ?? null);

                    // 3. Simpan Anak Sub Menu (Level 3) jika ada
                    if (!empty($subData['sub_sub_menus']) && is_array($subData['sub_sub_menus'])) {
                        foreach ($subData['sub_sub_menus'] as $ssIdx => $ssData) {
                            if (empty($ssData['name']) || empty($ssData['url'])) {
                                continue;
                            }

                            $ssMeta = [];
                            if (!empty($ssData['title_key'])) {
                                $ssMeta['title_key'] = trim($ssData['title_key']);
                            }
                            if (!empty($ssData['title_en'])) {
                                $ssMeta['title_en'] = trim($ssData['title_en']);
                            }

                            $ssMenu = Menu::create([
                                'name' => $ssData['name'],
                                'url' => $ssData['url'],
                                'category' => $validated['category'] ?? null,
                                'icon' => $ssData['icon'] ?? null,
                                'paths' => isset($ssData['paths']) ? (int)$ssData['paths'] : null,
                                'meta' => !empty($ssMeta) ? $ssMeta : null,
                                'active' => true,
                                'orders' => isset($ssData['orders']) ? (int)$ssData['orders'] : ($ssIdx + 1),
                                'main_menu_id' => $subMenu->id,
                            ]);

                            $ssPermissions = $ssData['permissions'] ?? ['read'];
                            $this->syncPermissions($ssMenu, $ssPermissions, $ssData['url'], $roles);
                            $this->syncTranslations($ssMeta['title_key'] ?? null, $ssData['name'], $ssMeta['title_en'] ?? null);
                        }
                    }
                }
            }

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu berhasil ditambahkan.',
                    'data' => $menu->load('permissions'),
                ]);
            }

            return redirect()->route('appsupport.menu.index')->with('success', 'Menu berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan menu: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan menu: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified menu.
     */
    public function show(Menu $menu)
    {
        return response()->json([
            'success' => true,
            'data' => $menu->load(['permissions.roles', 'parentMenu', 'subMenus']),
        ]);
    }

    /**
     * Show form or json for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        return response()->json([
            'success' => true,
            'data' => $menu->load('permissions.roles'),
            'roles' => $menu->assigned_roles,
        ]);
    }

    /**
     * Update the specified menu.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();
        $permissions = $request->input('permissions', []);
        $roles = $request->input('roles', []);

        $meta = is_array($menu->meta) ? $menu->meta : [];
        if ($request->filled('title_key')) {
            $meta['title_key'] = trim($request->input('title_key'));
        } else {
            unset($meta['title_key']);
        }

        if ($request->filled('title_en')) {
            $meta['title_en'] = trim($request->input('title_en'));
        } else {
            unset($meta['title_en']);
        }

        DB::beginTransaction();
        try {
            $menu->update([
                'name' => $validated['name'],
                'url' => $validated['url'],
                'category' => $validated['category'] ?? null,
                'icon' => $validated['icon'] ?? null,
                'paths' => $validated['paths'] ?? null,
                'meta' => !empty($meta) ? $meta : null,
                'active' => $request->boolean('active', true),
                'orders' => $validated['orders'] ?? 0,
                'main_menu_id' => $validated['main_menu_id'] ?? null,
            ]);

            $this->syncPermissions($menu, $permissions, $validated['url'], $roles);
            $this->syncTranslations($meta['title_key'] ?? null, $validated['name'], $meta['title_en'] ?? null);

            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu berhasil diperbarui.',
                    'data' => $menu->load('permissions'),
                ]);
            }

            return redirect()->route('appsupport.menu.index')->with('success', 'Menu berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui menu: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui menu: ' . $e->getMessage());
        }
    }

    /**
     * Sync permissions and roles for menu based on CRUD action list.
     */
    protected function syncPermissions(Menu $menu, array $permissions, string $url, array $roles = []): void
    {
        $routeKey = trim(str_replace(['/', '\\'], '.', trim($url, '/')));
        if (empty($permissions) || empty($routeKey)) {
            $menu->permissions()->detach();
            return;
        }

        $permissionIds = [];
        foreach ($permissions as $perm) {
            $action = strtolower(trim(explode(' ', $perm)[0] ?? $perm));
            if ($action === '') continue;

            $permName = "{$action} {$routeKey}";
            $permission = Permission::firstOrCreate([
                'name' => $permName,
                'guard_name' => 'web',
            ]);

            if (!empty($roles)) {
                $permission->syncRoles($roles);
            }

            $permissionIds[] = $permission->id;
        }

        $menu->permissions()->sync(array_unique($permissionIds));
    }

    /**
     * Sync translations in lang/id/menu.php and lang/en/menu.php.
     */
    protected function syncTranslations(?string $key, ?string $idValue, ?string $enValue): void
    {
        if (empty($key)) {
            return;
        }

        $idValue = $idValue ?? $key;
        $enValue = $enValue ?? $idValue;

        foreach (['id' => $idValue, 'en' => $enValue] as $locale => $val) {
            $path = lang_path("{$locale}/menu.php");
            if (!File::exists($path)) {
                continue;
            }

            $content = File::get($path);
            $escapedKey = str_replace("'", "\\'", $key);
            $escapedVal = str_replace("'", "\\'", $val);
            $pattern = "/'{$escapedKey}'\s*=>\s*'.*?',/";
            $newLine = "    '{$escapedKey}' => '{$escapedVal}',";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $newLine, $content);
            } else {
                $lastBracket = strrpos($content, '];');
                if ($lastBracket !== false) {
                    $content = substr($content, 0, $lastBracket) . $newLine . "\n];\n";
                }
            }
            File::put($path, $content);
        }
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(Request $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            $menu->permissions()->detach();
            $menu->delete();
            DB::commit();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Menu berhasil dihapus.',
                ]);
            }

            return redirect()->route('appsupport.menu.index')->with('success', 'Menu berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus menu: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }
}
