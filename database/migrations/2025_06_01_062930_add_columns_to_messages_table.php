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
       Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->after('id');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade')->after('user_id');
            $table->text('message')->nullable()->after('event_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['event_id']);
            $table->dropColumn(['user_id', 'event_id', 'message']);
        });;
    }
};
