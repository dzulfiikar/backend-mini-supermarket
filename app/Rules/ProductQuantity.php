<?php

namespace App\Rules;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Rule;

class ProductQuantity implements Rule
{

    private $referredField = null;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $referredField)
    {
        $this->referredField = $referredField;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $products = request()->input($this->referredField);
        foreach($products as $product){
            $available_stocks = Inventory::where('product_id', $product)->where('remaining_stock', '>', 0)->get('remaining_stock')->sum('remaining_stock');
            if($available_stocks >= $value){
                return true;
            }else {
                return false;
            }
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Item quantiy exceeds available stock';
    }
}
