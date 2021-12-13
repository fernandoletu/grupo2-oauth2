<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Indices
            $table->index('nombre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropForeign('created_user_id');
            $table->dropForeign('updated_user_id');
            $table->dropForeign('deleted_user_id');
        });

        Schema::dropIfExists('course');
    }
}
