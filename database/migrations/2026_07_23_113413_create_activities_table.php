<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | User yang melakukan aktivitas
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Informasi aktivitas
            |--------------------------------------------------------------------------
            */

            $table->string('module');

            /*
            contoh:
            Product
            Stock Transaction
            Supplier
            User
            */


            $table->string('action');

            /*
            contoh:
            CREATE
            UPDATE
            DELETE
            CONFIRM
            REJECT
            */


            $table->text('description');


            /*
            |--------------------------------------------------------------------------
            | Optional reference
            |--------------------------------------------------------------------------
            */

            $table->string('subject_type')
                ->nullable();


            $table->unsignedBigInteger('subject_id')
                ->nullable();


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};