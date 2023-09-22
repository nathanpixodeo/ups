<?php
namespace UPS\Shipping\Model\WeightBased;

class WeightPacketUtil
{
    protected $result;
    public function __construct(
        
    ) {
        $this->result    = new \UPS\Shipping\Model\WeightBased\WeightPackResult;
    }
    public function pack_items_into_weight_box($items, $max_weight)
    {
        $boxes        =    [];
        $unpacked    =    [];
        foreach ($items as $item) {
            $fitted            =    false;
            $item_weight    =    $item['weight'];
            foreach ($boxes as $box_key => $box) {
                if (($max_weight-$box['weight'])    >=    $item_weight) {
                    $boxes[$box_key]['weight']                =    $boxes[$box_key]['weight']+$item_weight;
                    $boxes[$box_key]['items'][]                =    $item['data'];
                    $fitted=true;
                }
            }
            if (!$fitted) {
                if ($item_weight    <=    $max_weight) {
                    $boxes[]    =    [
                        'weight'                =>    $item_weight,
                        'items'                    =>    [$item['data']],
                    ];
                } else {
                    $unpacked[]    =    [
                        'weight'                =>    $item_weight,
                        'items'                    =>    [$item['data']],
                    ];
                }
            }
        }
        $result    =    $this->result;
        $result->set_packed_boxes($boxes);
        $result->set_unpacked_items($unpacked);
        return $result;
    }

    public function pack_all_items_into_one_box($items)
    {
        $boxes            =    [];
        $total_weight    =    0;
        $box_items            =    [];
        foreach ($items as $item) {
            $total_weight    =    $total_weight    +    $item['weight'];
            $box_items[]        =    $item['data'];
        }
        $boxes[]    =    [
            'weight'    =>    $total_weight,
            'items'        =>    $box_items
        ];
        $result    =    $this->result;
        $result->set_packed_boxes($boxes);
        return $result;
    }
}
