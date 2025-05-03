<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        $this->logOperation($product, 'Création');
    }

    public function updated(Product $product)
    {
        $changes = $product->getChanges();
        $original = $product->getOriginal();

        if (!empty($changes)) {
            $action = 'Mise à jour';

            if (array_key_exists('quantity', $changes)) {
                if ($changes['quantity'] > $original['quantity']) {
                    $action = 'Mise à jour +';
                } elseif ($changes['quantity'] < $original['quantity']) {
                    $action = 'Mise à jour -';
                }
            }

            $this->logOperation($product, $action, $changes);
        }
    }

    public function deleted(Product $product)
    {
        $this->logOperation($product, 'Suppression');
    }

    protected function logOperation(Product $product, string $action, array $changes = null): void
    {
        Operation::create([
            'product_id'   => $product->id,
            'user_id'      => Auth::id(),
            'product_name' => $product->name ?? 'Nom inconnu',
            'action'       => $action,
            'changes'      => $changes ? json_encode($changes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : null,
        ]);
    }
}
