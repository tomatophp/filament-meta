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
        Schema::table('metas', function (Blueprint $table) {
            $table->string('model_id')->nullable()->change();
            $table->string('model_type')->nullable()->change();

            $table->string('key_value')->index()->nullable();
            $table->string('type')->nullable()->default('meta')->index();
            $table->string('response')->default('ok')->index();

            $table->date('date')->nullable();
            $table->time('time')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metas', function (Blueprint $table) {
            $table->string('model_id')->change();
            $table->string('model_type')->change();

            $table->dropColumn('key_value');
            $table->dropColumn('type');
            $table->dropColumn('response');

            $table->dropColumn('date');
            $table->dropColumn('time');
        });
    }
};
