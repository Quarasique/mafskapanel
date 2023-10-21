<?php

use App\Enums\Targets;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('meetings', function (Blueprint $table) {
            $table
                ->enum(
                    'targets',
                    array_column(Targets::cases(), 'value')
                )
                ->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->integer('vote_weight')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('vote_weight');
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->dropColumn('targets');
        });
    }
};
