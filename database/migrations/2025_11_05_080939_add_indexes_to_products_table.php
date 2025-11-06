<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update stock default value
        DB::statement('ALTER TABLE products MODIFY stock INT NOT NULL DEFAULT 0');

        // Tambah indexes hanya jika belum ada
        $this->createIndexIfNotExists('products', 'slug', 'products_slug_index');
        $this->createIndexIfNotExists('products', 'is_active', 'products_is_active_index');
        $this->createIndexIfNotExists('products', 'created_at', 'products_created_at_index');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes jika ada
        $this->dropIndexIfExists('products', 'products_slug_index');
        $this->dropIndexIfExists('products', 'products_is_active_index');
        $this->dropIndexIfExists('products', 'products_created_at_index');
    }

    /**
     * Create index if not exists
     */
    private function createIndexIfNotExists(string $table, string $column, string $indexName): void
    {
        $exists = DB::select("
            SELECT COUNT(*) as index_exists
            FROM information_schema.statistics
            WHERE table_schema = DATABASE()
            AND table_name = ?
            AND index_name = ?
        ", [$table, $indexName]);

        if ($exists[0]->index_exists == 0) {
            DB::statement("CREATE INDEX {$indexName} ON {$table} ({$column})");
            echo "✓ Index {$indexName} created\n";
        } else {
            echo "- Index {$indexName} already exists, skipped\n";
        }
    }

    /**
     * Drop index if exists
     */
    private function dropIndexIfExists(string $table, string $indexName): void
    {
        $exists = DB::select("
            SELECT COUNT(*) as index_exists
            FROM information_schema.statistics
            WHERE table_schema = DATABASE()
            AND table_name = ?
            AND index_name = ?
        ", [$table, $indexName]);

        if ($exists[0]->index_exists > 0) {
            DB::statement("DROP INDEX {$indexName} ON {$table}");
            echo "✓ Index {$indexName} dropped\n";
        } else {
            echo "- Index {$indexName} not found, skipped\n";
        }
    }
};
