<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('nature', ['physical', 'legal']);
            $table->string('document');
            $table->string('ie')->nullable();
            $table->boolean('icms_taxpayer')->default(false);
            $table->string('business_unit')->nullable();
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_client')->default(false);
            $table->boolean('is_employee')->default(false);
            $table->boolean('is_supplier')->default(false);
            $table->boolean('is_partner')->default(false);
            $table->boolean('has_price_table')->default(true);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
};
