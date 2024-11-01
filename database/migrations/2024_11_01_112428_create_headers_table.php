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
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('title1');
            $table->string('title_2')->nullable();
            $table->text('Short_desc')->nullable();
            $table->text('back_img')->nullable();
            $table->text('prof_img')->nullable();
            $table->string('btn_link')->nullable();
            $table->string('btn_text');
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headers');
    }
};
