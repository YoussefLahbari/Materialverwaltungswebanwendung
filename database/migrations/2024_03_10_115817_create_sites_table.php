<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('type_poste'); // Type of administrative unit (e.g., pachalik, cercle, district)
            $table->string('nom_bureau'); // Name of the office (annexe or caidat)
            $table->string('num_bureau');
            $table->string('telephone')->nullable(); // Telephone number
            $table->string('fax')->nullable(); // Fax number (optional)
            $table->string('wilaya')->default('Marrakech-Safi'); // Wilaya (default: Marrakech)
            $table->string('prefecture')->default('Marrakech'); // Prefecture (default: Marrakech)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
