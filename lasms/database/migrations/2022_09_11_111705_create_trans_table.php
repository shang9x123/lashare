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
        Schema::create('trans', function (Blueprint $table) {
            $table->id();
            $table->integer('from')->comment('tài khoản đến');
            $table->integer('to')->comment('tài khoản nhận');
            $table->integer('amount')->comment('Số tiền');
            $table->integer('before_transaction')->comment('Số dư trước giao dịch của người gửi mục đích là kiểm tra trước khi gửi xem đủ tiền không')->default(0);
            $table->unsignedTinyInteger('source')->comment('0 là nạp tiền vào tài khoản ,1 là thanh toán trong tài khoản ,2 là rút ra ngoài tài khoản')->default(0);
            $table->string('content')->comment('Nội dung chuyển tiền');
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
        Schema::dropIfExists('trans');
    }
};
