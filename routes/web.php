<?php

use Illuminate\Support\Facades\Route;

$dashboardPages = [
    '404' => 'dashboard.404',
    'blank' => 'dashboard.blank',
    'buttons' => 'dashboard.buttons',
    'cards' => 'dashboard.cards',
    'charts' => 'dashboard.charts',
    'forgot-password' => 'dashboard.forgot-password',
    'index' => 'dashboard.index',
    'login' => 'dashboard.login',
    'register' => 'dashboard.register',
    'tables' => 'dashboard.tables',
    'utilities-animation' => 'dashboard.utilities-animation',
    'utilities-border' => 'dashboard.utilities-border',
    'utilities-color' => 'dashboard.utilities-color',
    'utilities-other' => 'dashboard.utilities-other',
];

Route::view('/', 'dashboard.index')->name('dashboard');

foreach ($dashboardPages as $page => $view) {
    Route::view("/{$page}.html", $view)->name("dashboard.pages.{$page}");
}
