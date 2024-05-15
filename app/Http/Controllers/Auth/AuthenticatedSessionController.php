<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   */
  public function create(): View
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   */
  public function store(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();

    // add menu to session
    $role = Role::find(auth()->user()->role_id);
    // parsing menu and submenu array
    $menus = [];
    foreach ($role->menus as $menu) {
      $array = [
        'id' => $menu->id,
        'name' => $menu->name,
        'route' => $menu->route,
        'icon' => $menu->icon,
        'hs' => $menu->has_submenu,
        'role_id' => $menu->pivot->role_id,
      ];

      if ($menu->has_submenu) {
        $submenus = [];
        foreach ($menu->subMenus as $submenu) {
          array_push($submenus, [
            'id' => $submenu->id,
            'name' => $submenu->name,
            'route' => $submenu->route,
            'icon' => $submenu->icon,
          ]);
        }
        if ($submenus) $array = $array + ['submenus' => $submenus];
      }

      array_push($menus, $array);
    }

    // Add menu and submenu array to session
    session()->put('menu', $menus);

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  /**
   * Destroy an authenticated session.
   */
  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
