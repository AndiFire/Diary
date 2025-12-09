<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
   {
      Schema::create('likes', function (Blueprint $table) {
         $table->id();
         $table->foreignId('user_id')->constrained()->cascadeOnDelete();

         // Полиморфная связь (с уменьшенной длиной типа)
         $table->unsignedBigInteger('likeable_id');
         $table->string('likeable_type', 100);

         $table->index([ 'likeable_id', 'likeable_type']);

         $table->timestamps();
      });
   }

   public function down()
   {
      Schema::dropIfExists('likes');
   }
};
