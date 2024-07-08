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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('dept_type_id')->constrained('depttypes')->onDelete('cascade');
            $table->integer('vacancy');
            $table->string('registrationfees')->nullable();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('benefits')->nullable();
            $table->text('responsibility')->nullable();
            $table->text('qualifications')->nullable();
            $table->text('keywords')->nullable();
            $table->string('duration');
            $table->string('club_name');
            $table->string('club_location')->nullable();
            $table->string('club_website')->nullable();
            $table->timestamps();



            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
