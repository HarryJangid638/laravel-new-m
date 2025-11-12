<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->morphs('authenticatable'); // creates authenticatable_id + authenticatable_type
            $table->string('device')->nullable();
            $table->string('event')->nullable();
            $table->boolean('is_desktop')->nullable();
            $table->boolean('is_tablet')->nullable();
            $table->boolean('is_phone')->nullable();
            $table->boolean('is_mobile')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->boolean('is_robot')->nullable();
            $table->string('robot')->nullable();
            $table->json('languages')->nullable();
            $table->string('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('logged_in_at')->useCurrent();
            $table->timestamp('logged_out_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_histories');
    }
};
