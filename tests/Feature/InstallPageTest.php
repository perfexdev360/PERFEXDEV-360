<?php

use function Pest\Laravel\get;

test('installation page is accessible', function () {
    $response = get('/install');

    $response->assertStatus(200);
});
