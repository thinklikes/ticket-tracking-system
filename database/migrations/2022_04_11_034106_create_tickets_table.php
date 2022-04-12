<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedTinyInteger('type')->comment('1:bug 2: feature_request 3: test_case');
            $table->foreignId('creator_id')->comment('建立者');
            $table->foreignId('resolver_id')->nullable()->comment('解決者');
            $table->unsignedTinyInteger('severity')->nullable();
            $table->unsignedTinyInteger('priority')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
};
