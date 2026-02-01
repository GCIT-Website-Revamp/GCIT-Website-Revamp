<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('UPDATE teams SET category = JSON_ARRAY(category)');

        Schema::table('teams', function (Blueprint $table) {
            $table->json('category')->nullable()->change();
        });
        }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
        });
    }
};
