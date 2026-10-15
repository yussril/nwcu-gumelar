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
        Schema::table('articles', function (Blueprint $table) {
            // Social Media Official MWCNU Gumelar
            $table->string('social_facebook')->nullable()->after('image_url');
            $table->string('social_twitter')->nullable()->after('social_facebook');
            $table->string('social_instagram')->nullable()->after('social_twitter');
            $table->string('social_youtube')->nullable()->after('social_instagram');
            $table->string('social_whatsapp')->nullable()->after('social_youtube');
            $table->string('social_website')->nullable()->after('social_whatsapp');

            // Location / Map fields
            $table->decimal('latitude', 10, 8)->nullable()->after('social_website');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('location_name')->nullable()->after('longitude');
            $table->text('location_address')->nullable()->after('location_name');

            // Tags
            $table->json('tags')->nullable()->after('location_address');

            // Visibility / Access
            $table->string('visibility')->default('public')->after('tags'); // public, karta_nu, internal

            // Publish mode
            $table->string('publish_mode')->default('now')->after('visibility'); // now, scheduled
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'social_facebook',
                'social_twitter',
                'social_instagram',
                'social_youtube',
                'social_whatsapp',
                'social_website',
                'latitude',
                'longitude',
                'location_name',
                'location_address',
                'tags',
                'visibility',
                'publish_mode',
            ]);
        });
    }
};