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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo');
            $table->string('favicon');
            $table->text('colors');
            $table->unsignedSmallInteger('theme');
            $table->boolean('is_active')->default(true);

            $table->string('locale')->default('fr');
            $table->string('timezone')->default('UTC');

            $table->string('currency')->default('XAF');
            $table->string('currency_symbol')->default('CFA');

            $table->string('url_facebook')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_youtube')->nullable();
            $table->string('url_instagram')->nullable();
            $table->string('url_linkedin')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('meta_image')->nullable();

            $table->string('google_analytics')->nullable();
            $table->string('google_tag_manager')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_infos');
    }
};
