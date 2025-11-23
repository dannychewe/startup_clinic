<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('footer_items', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('url');
            $table->string('icon')->nullable()->after('url');
        });
    }

    public function down()
    {
        Schema::table('footer_items', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'icon']);
        });
    }

};
