<?php

use function Pest\Laravel\get;

test('installation page is accessible', function () {
    config(['app.installed' => false]);

    $response = get('/install');

    $response->assertStatus(200);
});

test('redirects to install when not installed', function () {
    config(['app.installed' => false]);

    get('/')->assertRedirect('/install');
});
