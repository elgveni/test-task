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
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identifier');
            $table->longText('description')->nullable();
            $table->string('homepage')->nullable();
            $table->boolean('is_public')->default(true);

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('projects');

            $table->boolean('inherit_members')->default(false);
            $table->integer('default_assigned_to_id')->nullable();

            $table->unsignedBigInteger('default_version_id')->nullable();
            $table->foreign('default_version_id')->references('id')->on('versions');

            $table->json('tracker_ids')->nullable();
            $table->json('enabled_module_names')->nullable();
            $table->json('issue_custom_field_ids')->nullable();
            $table->json('custom_field_values')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
        Schema::dropIfExists('versions');
    }
};
