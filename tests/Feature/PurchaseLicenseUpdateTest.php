<?php

use App\Models\{User, Product, Version, Release, ReleaseChannel, FileArtifact, Invoice};
use App\Services\FlowService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use function Pest\Laravel\actingAs;

it('issues license on purchase and serves update download', function () {
    Storage::shouldReceive('disk')->with('s3')->andReturn(new class {
        public function temporaryUrl($path, $exp) { return 'https://files.test/'.$path; }
    });

    $user = User::factory()->create();
    $product = Product::factory()->create();

    $license = app(FlowService::class)->purchaseProduct($user, $product);

    $invoice = Invoice::factory()->create(['order_id' => $license->order_id]);
    expect($invoice->order_id)->toBe($license->order_id);

    $channel = ReleaseChannel::create(['name' => 'stable']);
    $version = Version::create(['product_id' => $product->id, 'number' => '1.0.0']);
    $release = Release::create([
        'product_id' => $product->id,
        'version_id' => $version->id,
        'release_channel_id' => $channel->id,
        'is_published' => true,
        'released_at' => now(),
    ]);
    FileArtifact::create(['release_id' => $release->id, 'path' => 'build.zip', 'hash' => 'abc123']);

    $response = $this->getJson('/api/updates?license_key='.$license->license_key);
    $response->assertOk()->assertJson(['version' => '1.0.0', 'checksum' => 'abc123']);

    $downloadUrl = $response->json('download_url');
    actingAs($user)->get($downloadUrl)->assertRedirect('https://files.test/build.zip');
});
