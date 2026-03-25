<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/admin/rindu-bundas/create', 'GET')
);
echo $response->getContent();
$kernel->terminate($request, $response);
