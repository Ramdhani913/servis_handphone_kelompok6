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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->foreignId('customer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('technician_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('handphone_id')->references('id')->on('handphones')->onUpdate('cascade')->onDelete('cascade');
            $table->text('damage_description');
            $table->enum('status', ['1', '2', '3', '4', '5'])->default('1')->description('1 = accepted, 2 = Process, 3 = Finished, 4 = Taken, 5 = Canceled');
            $table->double('total_cost');
            $table->double('other_cost')->nullable();
            $table->double('paid')->nullable();
            $table->double('change')->nullable();
            $table->enum('payment_method', ['1', '2'])->nullable()->description('1 = Cash, 2 = Transfer');
            $table->enum('status_paid', ['0', '1'])->default('0')->description('0 = Paid, 1 = Debt, 2 = Unpaid');
            $table->dateTime('received_date')->nullable();
            $table->dateTime('completed_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
