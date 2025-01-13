<?php

use App\Models\Client;
use App\Models\Team;
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
        Schema::create('projects', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('banner_img');
            // $table->string('client_name');
            // $table->string('team_name');
            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(Team::class);
            $table->string('slug');
            $table->string('project_number');
            $table->tinyInteger('isActive')->default('1');
            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
