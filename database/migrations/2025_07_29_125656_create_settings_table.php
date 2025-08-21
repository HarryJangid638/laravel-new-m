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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 200)->default(null)->nullable();
            $table->text('value')->default(null)->nullable();
            $table->string('type',191)->default(null)->nullable();
            $table->string('display_name',191)->default(null)->nullable();
            $table->text('details')->default(null)->nullable();
            $table->enum('group', ['web','mail'])->nullable(); //['web','app','payment','mail']
            $table->tinyInteger('status')->default(1)->comment('0=> inactive, 1=> active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
