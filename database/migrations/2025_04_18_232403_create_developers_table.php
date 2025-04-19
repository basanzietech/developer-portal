<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration {
    public function up() {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->char('api_key', 32)->nullable()->unique();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('developers'); }
}