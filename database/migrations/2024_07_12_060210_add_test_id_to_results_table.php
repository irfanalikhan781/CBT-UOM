<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedBigInteger('test_id')->after('department_id');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            //
            $table->dropForeign(['test_id']);
            $table->dropColumn('test_id');
        });
    }
};
