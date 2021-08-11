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
            $available_stocks = Inventory::where('product_id', $product)->where('product_stock', '>', '0')->get('product_stock')->sum('product_stock');
            if($available_stocks <= $value){
                return false;
            }else {
                return true;
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
