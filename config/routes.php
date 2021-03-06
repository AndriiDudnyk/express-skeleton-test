<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 */

/** @var \Zend\Expressive\Application $app */

$app->get('/', App\Home\HomePageAction::class, 'home');
$app->route(
    '/api/datastore[/{resourceName}[/{id}]]',
    'api-datastore',
    ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
    'api-datastore'
);
