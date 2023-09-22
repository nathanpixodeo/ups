<?php
namespace UPS\Shipping\Model\WeightBased;

class WeightPackSimple extends \UPS\Shipping\Model\WeightBased\WeightPackStrategy
{
    // public function __construct(){
    //     parent::__construct();
    // }

    public function pack_items()
    {
        $items=$this->get_packable_items();
        $boxes            =    [];
        $total_weight    =    0;
        foreach ($items as $item) {
            $total_weight    +=    $item['weight'];
        }
        $max_weight    =    $this->get_max_weight();
        if (!is_numeric($max_weight)) {
            $result    =    $this->pack_util->pack_all_items_into_one_box($items);
        } else {
            if (!$total_weight || !$max_weight) {
                $result    =    new WeightPackResult();
                $result->set_error('Invalid weight entered for box or order total weight is zero');
            } else {
                do {
                    $pack_weight    =    ($total_weight/$max_weight)>1?$max_weight:$total_weight;
                    $boxes[]    =    [
                        'weight'    =>    $pack_weight
                    ];
                    $total_weight    =    $total_weight-$pack_weight;
                } while ($total_weight);

                $result    =    new WeightPackResult();
                $result->set_packed_boxes($boxes);
            }
        }
        $this->set_result($result);
    }
}
