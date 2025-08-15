<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('version_id')->constrained()->cascadeOnDelete();
            $table->foreignId('release_channel_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_published')->default(false);
            $table->json('notes')->nullable();
            $table->boolean('forced_update')->default(false);
            $table->timestamp('released_at')->nullable();
            $table->timestamps();
            $table->unique(['version_id', 'release_channel_id'], 'version_channel_unique');
        });

        Schema::table('file_artifacts', function (Blueprint $table) {
            $table->foreignId('release_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('file_artifacts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('release_id');
        });

        Schema::dropIfExists('releases');
    }
};
