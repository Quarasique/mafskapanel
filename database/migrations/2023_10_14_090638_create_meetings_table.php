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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('time');
        });

        Schema::create('meeting_role', function (Blueprint $table) {
            $table->foreignId('role_id');
            $table->foreignId('meeting_id');
            $table->foreign('role_id')->on('roles')->references('id');
            $table->foreign('meeting_id')->on('meetings')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
