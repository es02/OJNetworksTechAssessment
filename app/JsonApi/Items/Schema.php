<?php

namespace App\JsonApi\Posts;

use Neomerx\JsonApi\Schema\SchemaProvider;

class Schema extends SchemaProvider
{

    /**
     * @var string
     */
    protected $resourceType = 'items';

    /**
     * @param $resource
     *      the domain record being serialized.
     * @return string
     */
    public function getId($resource)
    {
        return (string) $resource->getRouteKey();
    }

    /**
     * @param $resource
     *      the domain record being serialized.
     *      defining this here means if the remote schema changes down the track
     *      we only need to update this class
     * @return array
     */
    public function getAttributes($item)
    {
        return [
            'tags' => $item->tags,
            'is_answered' => $item->is_answered,
            'view_count' => $item->view_count,
            'accepted_answer_id' => $item->accepted_answer_id,
            'answer_count' => $item->answer_count,
            'score' => $item->score,
            'last_activity_date' => $item->last_activity_date->toW3cString(),
            'creation_date' => $item->creation_date->toW3cString(),
            'question_id' => $item->question_id,
            'link' => $item->link,
            'title' => $item->title,
            'reputation' => $item->owner->reputation,
            'user_id' => $item->owner->user_id,
            'user_type' => $item->owner->user_type,
            'accept_rate' => $item->owner->accept_rate,
            'profile_image' => $item->owner->profile_image,
            'display_name' => $item->owner->display_name,
            'user_link' => $item->owner->link,
        ];
    }
}
