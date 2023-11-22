<?php

use App\Models\Brand;
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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->enum('boycott_status', array_keys(Brand::BOYCOTT_STATUSES))->default(0);
            $table->unsignedTinyInteger('visibility')->default(0);
            $table->unsignedBigInteger('parent_brand_id')->nullable();
            $table->foreign('parent_brand_id')->references('id')->on('brands');
            $table->date('established_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
