<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Add new columns
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('contact_number')->after('email');

            // Optional: drop old name column
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Re-add old column
            $table->string('name')->after('id');

            // Remove new columns
            $table->dropColumn(['first_name', 'last_name', 'contact_number']);
        });
    }
};
