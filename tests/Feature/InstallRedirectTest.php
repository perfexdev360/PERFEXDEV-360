<?php

use function Pest\Laravel\get;

// ensure redirect uses request's domain when app not installed and .env missing

test('redirect uses current domain when env missing', function () {
    config(['app.installed' => false]);

    get('https://example.com/')->assertRedirect('https://example.com/install');
});
