<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('main_image');
            $table->json('gallery_images')->nullable();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('service_id');
            $table->index('order');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
