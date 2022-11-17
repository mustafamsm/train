<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50);//رقم الفاتورة
            $table->date('invoice_Date')->nullable();//تاريخ الفاتورة
            $table->date('Due_date')->nullable();//تاريخ الاستحقاق
            $table->string('product', 50);//المنتج
            $table->bigInteger( 'section_id' )->unsigned();//القسم
           $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');//
           $table->decimal('Amount_collection',8,2)->nullable();//
           $table->decimal('Amount_Commission',8,2);//
            $table->decimal('Discount',8,2);//
            $table->decimal('Value_VAT',8,2);//قيمة الضريبة
            $table->string('Rate_VAT', 999);//نسبة الضريبة
            $table->decimal('Total',8,2);//
            $table->string('Status', 50);//مدفوعة او غير مفوعة
            $table->integer('Value_Status');//
            $table->text('note')->nullable();//
            $table->date('Payment_Date')->nullable();//
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
