<?php

namespace App\View\Components\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Navbar extends Component
{
    public array $menu = [];

    public function __construct()
    {
        $this->menu = [
            [
                'title' => 'Menu',
                'type' => 'label',
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'home',
                'href' => route('admin.dashboard'),
                'active' => Route::is('admin.dashboard'),
                'type' => 'link',
            ],
            [
                'title' => 'Users',
                'icon' => 'users',
                'href' => route('admin.users'),
                'active' => Route::is('admin.users*'),
                'type' => 'link',
            ],
        ];
    }

    public function render(): View
    {
        return view('components.admin.navbar');
    }
}
