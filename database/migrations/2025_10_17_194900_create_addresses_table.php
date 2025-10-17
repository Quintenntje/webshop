<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code', 20);
            $table->timestamp('updated_at')->default(now());
            $table->timestamp('created_at')->default(now());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
