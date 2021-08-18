<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ceklevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->jabatan == "User") {
            $menu = [
                [
                    'text' => 'Dashbord',
                    'url'  => 'home',
                    'can'  => 'manage-blog',
                ],
                ['header' => 'Quotation'],
                [
                    'text'         => 'Master',
                    'url'          => 'masterquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                [
                    'text'         => 'Daftar Qoutation',
                    'url'          => 'daftarquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                ['header'   => 'Data Customer'],
                [
                    'text'         => 'Daftar Customer',
                    'url'          => 'customer',
                    'icon'         => 'fas fa-address-book',
                ],

            ];
        } elseif (auth()->user()->jabatan == "Administrator") {
            $menu = [
                [
                    'text' => 'Dashbord',
                    'url'  => 'home',
                    'can'  => 'manage-blog',
                ],
                [
                    'text'         => 'Laporan Penjualan',
                    'url'          => 'laporan',
                    'icon'         => 'fas fa-shipping-fast',
                ],
                ['header' => 'Quotation'],
                [
                    'text'         => 'Master',
                    'url'          => 'masterquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                [
                    'text'         => 'Daftar Qoutation',
                    'url'          => 'daftarquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                ['header' => 'Data Barang'],
                [
                    'text'         => 'Data Produk',
                    'url'          => 'daftarproduk',
                    'icon'         => 'fas fa-clipboard-list',
                ],
                ['header'   => 'Data Customer'],
                [
                    'text'         => 'Daftar Customer',
                    'url'          => 'customer',
                    'icon'         => 'fas fa-address-book',
                ],
                
            ];
        } elseif (auth()->user()->jabatan == "Staff IT"){
            $menu =[
                [
                    'text' => 'Dashbord',
                    'url'  => 'home',
                    'can'  => 'manage-blog',
                ],
                [
                    'text'         => 'Laporan Penjualan',
                    'url'          => 'laporan',
                    'icon'         => 'fas fa-shipping-fast',
                ],
                ['header' => 'Quotation'],
                [
                    'text'         => 'Master',
                    'url'          => 'masterquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                [
                    'text'         => 'Daftar Qoutation',
                    'url'          => 'daftarquotation',
                    'icon'         => 'far fa-fw fa-file',
                ],
                ['header' => 'Data Barang'],
                [
                    'text'         => 'Data Produk',
                    'url'          => 'daftarproduk',
                    'icon'         => 'fas fa-clipboard-list',
                ],
                ['header'   => 'Data Customer'],
                [
                    'text'         => 'Daftar Customer',
                    'url'          => 'customer',
                    'icon'         => 'fas fa-address-book',
                ],
            ['header'   => 'account_settings'],

                [
                    'text' => 'Managemen User',
                    'url'  => 'managemenuser',
                    'icon' => 'fas fa-fw fa-user',
                ],
            ];
        }else {
            $menu = [
                [
                    'type'         => 'navbar-search',
                    'text'         => 'search',
                    'topnav_right' => true,
                ],
                [
                    'type'         => 'fullscreen-widget',
                    'topnav_right' => true,
                ],

                // Sidebar items:

            ];
        }

        config(["adminlte.menu" => $menu]);

        return $next($request);
    }
}
