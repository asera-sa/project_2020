<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Cart
{
    public readonly string $sessionKey;

    public Collection $items;

    public function __construct()
    {
        $this->sessionKey = "cart-" . str(request()->ip())->replace('.', '-');

        $this->items = new Collection(Session::get($this->sessionKey), []);
    }

    public function all(): Collection
    {
        $items = $this->items->map(function ($item) {
            $product = Product::with(['category', 'shop'])->find($item['product_id']);

            return (object) [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->getImage(),
                'category_name' => $product->category->name,
                'shop_id' => $product->shop->id,
                'shop_name' => $product->shop->name,
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ];
        });

        return $items;
    }

    public function add(Product $product, int $quantity = 1): void
    {
        // Find the item in the session with the matching product ID
        $index = $this->items->search(fn($item) => $item['product_id'] === $product->id);

        if ($index !== false) {
            // If the item exists, increment its quantity and calculate total price.
            $this->items[$index]['quantity'] += 1;
            $this->items[$index]['total_price'] = $this->items[$index]['unit_price'] * $this->items[$index]['quantity'];

            flash()->success('تمت زيادة كمية المنتج في السلة بنجاح');
        } else {
            // Otherwise, add the new product details to the session
            $this->items->push($this->getProductDetails($product));

            flash()->success('تمت إضافة المنتج للسلة بنجاح');
        }

        // Update the session with the modified items
        Session::put($this->sessionKey, $this->items);

        // Decrement the product's quantity
        $product->decrement('quantity');
    }

    public function delete(Product $product): void
    {
        // Find the item to remove and get its quantity
        $item = $this->items->firstWhere('product_id', $product->id);

        if (! $item) {
            return;
        }

        // Filter out the item with the matching product ID
        $filteredItems = $this->items->reject(fn($item) => $item['product_id'] === $product->id);

        // Update the session with the filtered items
        Session::put($this->sessionKey, $filteredItems);

        // Increment the product's quantity by the amount removed from the cart
        $product->increment('quantity', $item['quantity']);

        flash()->success('تمت إزالة المنتج من السلة بنجاح');
    }

    private function getProductDetails(Product $product, int $quantity = 1): Collection
    {
        return collect([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $product->price,
            'total_price' => $quantity * $product->price,
        ]);
    }
}
