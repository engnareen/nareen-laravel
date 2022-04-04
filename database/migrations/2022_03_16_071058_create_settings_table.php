<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name');
            $table->text('site_description');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable()->default('24.774265');
            $table->string('longitude')->nullable()->default('46.738586');
            $table->timestamps();
        });
        Setting::create(['site_name' => 'Nareen', 'site_description' => 'Here I share every thing about my works with the world, including some information about myself.',
            'email' => 'admin@info.com', 'phone' => '0597703112', 'whatsapp' => '+970597703112']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
