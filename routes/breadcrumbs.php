<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});




Breadcrumbs::for('asset.index', function (BreadcrumbTrail $trail) {

    $trail->push('Listasset', route('asset.index'));
});


Breadcrumbs::for('asset.create', function (BreadcrumbTrail $trail) {

    $trail->parent('asset.index');
    $trail->push('AddAsset', route('asset.create'));
});
Breadcrumbs::for('asset.edit', function (BreadcrumbTrail $trail, $id) {

    $trail->parent('asset.index');
    $trail->push('Edit Asset', route('asset.edit', $id));
});





Breadcrumbs::for('employeedetails', function (BreadcrumbTrail $trail) {

    $trail->push('List Employee', route('employeedetails'));
});


Breadcrumbs::for('employee.create', function (BreadcrumbTrail $trail) {
    $trail->parent('employeedetails');
    $trail->push('Add employee', route('employee.create'));
});

Breadcrumbs::for('employee.edit', function (BreadcrumbTrail $trail, $id) {

    $trail->parent('employeedetails');
    $trail->push('Edit Employee', route('employee.edit', $id));
});

Breadcrumbs::for('employee.details', function (BreadcrumbTrail $trail, $id) {

    $trail->parent('employeedetails');
    $trail->push('Edit Employee', route('employee.details', $id));
});





Breadcrumbs::for('ticket.raise', function (BreadcrumbTrail $trail) {

    $trail->push('Raise Ticket', route('ticket.raise'));
});


Breadcrumbs::for('ticket.display', function (BreadcrumbTrail $trail) {

    $trail->parent('ticket.raise');
    $trail->push('Ticket Status', route('ticket.display'));
});


Breadcrumbs::for('ticket.show', function (BreadcrumbTrail $trail, $id) {

    $trail->parent('ticket.display');
    $trail->push('Ticket View', route('ticket.show', $id));
});




Breadcrumbs::for('ticket.admindisplay', function (BreadcrumbTrail $trail) {

    $trail->push('Ticket Status', route('ticket.admindisplay'));
});


Breadcrumbs::for('ticket.adminshow', function (BreadcrumbTrail $trail, $id) {

    $trail->parent('ticket.admindisplay');
    $trail->push('Ticket View', route('ticket.adminshow', $id));
});

Breadcrumbs::for('edashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('edashboard'));
});


Breadcrumbs::for('asset.list', function (BreadcrumbTrail $trail) {

    $trail->push('Listasset', route('asset.list'));
});

Breadcrumbs::for('employee.notification', function (BreadcrumbTrail $trail) {

    $trail->push('Notification', route('employee.notification'));
});

Breadcrumbs::for('notification.index', function (BreadcrumbTrail $trail) {

    $trail->push('Notification', route('notification.index'));
});
