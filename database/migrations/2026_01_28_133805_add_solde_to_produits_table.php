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
        Schema::table('produits', function (Blueprint $table) {
            $table->boolean('en_solde')->default(false);
            $table->decimal('prix_solde', 10, 2)->nullable();
            $table->integer('pourcentage_reduction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropColumn(['en_solde', 'prix_solde', 'pourcentage_reduction']);
        });
    }
};
