<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->formatPrice($this->price),
            'stock' => $this->formatStock($this->stock),
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Format price to IDR currency
     */
    private function formatPrice(int $price): string
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    /**
     * Format stock with thousand separator
     */
    private function formatStock(int $stock): string
    {
        return number_format($stock, 0, ',', '.');
    }
}