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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_no', 20)->unique();
            $table->string('full_name', 100);
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->string('id_number', 20)->unique()->nullable();
            $table->date('date_joined');
            $table->enum('status', ['active', 'dormant', 'exited'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
