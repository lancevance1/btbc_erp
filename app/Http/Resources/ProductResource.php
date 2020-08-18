<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "type" => $this->type,
            "description" => $this->description,
            "size" => $this->size,
            "price" => number_format($this->price / 100, 2),
            "cost" => number_format($this->cost / 100, 2),
            "current_inventory" => $this->current_inventory,
            "order_quantity" => $this->order_quantity,
            "to_be_ordered" => $this->to_be_ordered,
            "current_inventory_value" => number_format($this->current_inventory_value / 100, 2),
            "belong_to" => $this->belong_to,
        ];
    }
}
