<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'recipient'   => $this->recipient,
            'vendor_id' => $this->vendor_id,
            'order_list' => OrderListResource::collection($this->order_list),
        ];
    }
}
