<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'dish_id' => $this->dish_id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'add_request' => $this->add_request,
        ];
    }
}
