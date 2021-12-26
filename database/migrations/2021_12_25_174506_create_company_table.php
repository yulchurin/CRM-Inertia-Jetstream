<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->string('phone', 16);
            $table->string('email', 50);
            $table->string('zip');
            $table->string('region');
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('office')->nullable();
            $table->string('OGRN', 13);
            $table->string('INN', 10);
            $table->string('KPP', 9);
            $table->string('bank_BIC', 9);
            $table->string('bank_name');
            $table->string('bank_account', 20);
            $table->string('bank_corr_account', 20);
            $table->string('manager_post');
            $table->string('manager_first_name');
            $table->string('manager_last_name');
            $table->string('manager_middle_name');
            $table->string('license_issuer');
            $table->string('license_number');
            $table->string('license_blank_series');
            $table->string('license_blank_number');
            $table->date('license_issuance_date');
            $table->softDeletes();
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
        Schema::dropIfExists('company');
    }
}
