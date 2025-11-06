<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'specifications',
        'price',
        'discount',
        'stock',
        'image',
        'is_active',
    ];

    protected $casts = [
        'specifications' => 'array',
        'price' => 'decimal:2',
        'discount' => 'integer',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk produk yang tersedia (stok > 0)
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Accessor untuk mendapatkan harga setelah diskon
    public function getFinalPriceAttribute()
    {
        if ($this->discount > 0) {
            return $this->price - ($this->price * $this->discount / 100);
        }
        return $this->price;
    }

    // Accessor untuk mendapatkan URL gambar lengkap
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/no-image.png');
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
