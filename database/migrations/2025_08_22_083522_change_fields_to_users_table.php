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
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();

            $table->string('document')->nullable()->after('type');
            $table->string('phone')->nullable()->after('document');
            $table->string('zip_code')->nullable()->after('phone');
            $table->string('public_place')->nullable()->after('zip_code');
            $table->string('number')->nullable()->after('public_place');
            $table->string('complement')->nullable()->after('number');
            $table->string('district')->nullable()->after('complement');
            $table->string('city')->nullable()->after('district');
            $table->string('state')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->change();

            $table->dropColumn('document');
            $table->dropColumn('phone');
            $table->dropColumn('zip_code');
            $table->dropColumn('public_place');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('district');
            $table->dropColumn('city');
            $table->dropColumn('state');
        });
    }
};
