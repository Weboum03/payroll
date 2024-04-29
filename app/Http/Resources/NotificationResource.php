<?php
 
namespace App\Http\Resources;
 
use Illuminate\Http\Resources\Json\JsonResource;
 
class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(!is_array($this['data'])) {
            $data = json_decode($this['data'],true);
        } else {
            $data = $this['data'];
        }
        $title = (array_key_exists('title', $data))?$data['title']:null;
        $message = (array_key_exists('message', $data))?$data['message']:null;
        $messageDetails = (array_key_exists('message_details', $data))?$data['message_details']:null;
        return [
            'id' => $this['id'],
            'type' => $this['type'],
            'title' => $title,
            'message' => $message,
            'message_details' => $messageDetails,
            'read_at' => $this['read_at'],
            'status' => $this['status'],
            'created_at' => $this['created_at'],
        ];
    }
}
