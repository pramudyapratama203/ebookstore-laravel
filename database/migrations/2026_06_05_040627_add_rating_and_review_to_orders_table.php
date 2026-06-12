<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah kolom sudah ada di database sebelum mencoba menambahkannya
        $hasRating = Schema::hasColumn('orders', 'rating');
        $hasReview = Schema::hasColumn('orders', 'review');

        // Jika salah satu kolom belum ada, jalankan proses penambahan
        if (!$hasRating || !$hasReview) {
            Schema::table('orders', function (Blueprint $table) use ($hasRating, $hasReview) {
                if (!$hasRating) {
                    $table->unsignedTinyInteger('rating')->nullable()->after('status');
                }
                if (!$hasReview) {
                    $table->text('review')->nullable()->after('rating');
                }
            });
        }
    }

    public function down(): void
    {
        // Cek keberadaan kolom sebelum mencoba menghapusnya (mencegah error saat rollback)
        $hasRating = Schema::hasColumn('orders', 'rating');
        $hasReview = Schema::hasColumn('orders', 'review');

        if ($hasRating || $hasReview) {
            Schema::table('orders', function (Blueprint $table) use ($hasRating, $hasReview) {
                $columnsToDrop = [];
                if ($hasRating) $columnsToDrop[] = 'rating';
                if ($hasReview) $columnsToDrop[] = 'review';

                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};