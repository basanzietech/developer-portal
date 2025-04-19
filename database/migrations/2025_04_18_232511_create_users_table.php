<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id')->constrained()->onDelete('cascade');
            $table->string('phone');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('uid');
            // "day" field means remaining days
            $table->integer('remaining_days')->default(0);
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('username')->nullable();
            $table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('users'); }
}