<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Strona główna', route('dashboard'));
});

Breadcrumbs::for('test', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Testy', route('test'));
});
