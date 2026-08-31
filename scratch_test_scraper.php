<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blogs = App\Models\Blog::all();
foreach ($blogs as $b) {
    echo $b->id . ': ' . $b->title . ' (Tags: ' . $b->tags->count() . ")\n";
}
