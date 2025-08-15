<?php

use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

it('increments version and generates signed url', function () {
    Storage::shouldReceive('temporaryUrl')->andReturn('signed-url');

    $user = User::factory()->create();

    $doc1 = Document::create([
        'user_id' => $user->id,
        'type' => 'sow',
        'title' => 'First SOW',
        'path' => 'docs/sow-v1.pdf',
    ]);

    $doc2 = Document::create([
        'user_id' => $user->id,
        'type' => 'sow',
        'title' => 'Second SOW',
        'path' => 'docs/sow-v2.pdf',
    ]);

    expect($doc1->version)->toBe(1);
    expect($doc2->version)->toBe(2);
    expect($doc2->signed_url)->toBe('signed-url');
});

