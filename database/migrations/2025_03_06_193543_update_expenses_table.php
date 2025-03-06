<?php
// database/migrations/xxxx_xx_xx_update_expenses_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
            // This assumes 'categories' table exists
        });
    }

    public function down() {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
