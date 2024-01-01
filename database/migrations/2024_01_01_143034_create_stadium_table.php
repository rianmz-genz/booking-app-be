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
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->unique('stadium_name_index');
            $table->string('address')->nullable(false);
            $table->string(
                'phone'
            )->nullable(false);
            $table->string('description')->nullable(false);
            $table->json('images')->nullable(false);
            $table->string('open_at')->nullable(false);
            $table->string('closed_at')->nullable(false);
            $table->unsignedBigInteger('stadium_category_id');
            $table->timestamps();

            $table->foreign('stadium_category_id')->references('id')->on('stadium_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadiums');
    }
};
