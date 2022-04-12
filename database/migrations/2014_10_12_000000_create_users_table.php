<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name'              => 'admin',
                'email'             => 'admin@example.com',
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('adminadmin123'),
                'role_id'           => 1,
            ],
            [
                'name'              => 'pm',
                'email'             => 'pm@example.com',
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('pmpmpm123'),
                'role_id'           => 2,
            ],
            [
                'name'              => 'qa',
                'email'             => 'qa@example.com',
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('qaqaqa123'),
                'role_id'           => 3,
            ],
            [
                'name'              => 'rd',
                'email'             => 'rd@example.com',
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('rdrdrd123'),
                'role_id'           => 4,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
