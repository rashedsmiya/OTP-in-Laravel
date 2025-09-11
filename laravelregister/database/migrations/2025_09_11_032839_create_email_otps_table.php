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
            Schema::create('email_otps', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->string('otp');
                $table->timestamp('expired_at');
                $table->timestamps(); // keep this if you want created_at & updated_at
            });
        }


        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('email_otps');
        }
    };
