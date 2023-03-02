<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('no_urut');
            $table->date('tgl_opname');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lokasi_id')->constrained();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->foreignId('aset_id')->constrained();
            $table->foreignId('satuan_id')->constrained();
            $table->integer('jumlah')->default(1);
            $table->date('tgl_perolehan')->nullable();
            $table->string('no_dokumen_pembelian')->nullable();
            $table->integer('nilai_perolehan')->default(1);
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
        Schema::dropIfExists('inventaris');
    }
};
