<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('persentase');
            $table->timestamps();
        });
        DB::table('kategoris')->insert([
            'nama' => 'living',
            'persentase' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('kategoris')->insert([
            'nama' => 'playing',
            'persentase' => 30,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('kategoris')->insert([
            'nama' => 'saving',
            'persentase' => 20,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::create('sub_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('nama');
            $table->timestamps();
        });
        DB::table('sub_kategoris')->insert([
            'kategori_id' => 1,
            'nama' => 'makan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sub_kategoris')->insert([
            'kategori_id' => 2,
            'nama' => 'gaya hidup',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sub_kategoris')->insert([
            'kategori_id' => 3,
            'nama' => 'nabung saham',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sub_kategoris')->insert([
            'kategori_id' => 1,
            'nama' => 'parkir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('sub_kategoris')->insert([
            'kategori_id' => 1,
            'nama' => 'bensin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
