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
            $table->Enum('type', [ 'male', 'female']);
            $table->string('image_front');
            $table->string('image');

            $table->string('image_back');
            $table->Enum('postion', [ 'in', 'out']);

            $table->string('name');
            $table->string('national_ID');
            $table->string('card_Date');

            $table->string('governorate');
            $table->string('address');
            $table->string('work_place');

            $table->string('partisan');
            $table->string('country')->nullable();
            $table->string('Place_abroad')->nullable();

            $table->string('Passport_number')->nullable();
            $table->string('job');
            $table->string('qualification');

            $table->string('phone');
            $table->string('cv');

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
