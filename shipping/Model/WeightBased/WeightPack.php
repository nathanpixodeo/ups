<?php
namespace UPS\Shipping\Model\WeightBased;

class WeightPack
{
    private $package_requests;
    private $pack_obj;
    private $asc;
    private $dec;
    private $sim;
    public function __construct(
        
    ) {
        
    }
    public function _init($strategy, $options = [])
    {

        switch ($strategy) {
            case 'pack_ascending':
                $this->pack_obj    = new \UPS\Shipping\Model\WeightBased\WeightPackAscend();
                break;
                //case 'pack_descending':
            case 'pack_simple':
                $this->pack_obj    = new \UPS\Shipping\Model\WeightBased\WeightPackDescend();
                break;
            default:
                $this->pack_obj    = new \UPS\Shipping\Model\WeightBased\WeightPackSimple();
                break;
        }
    }

    public function set_max_weight($max_weight)
    {
        $this->pack_obj->set_max_weight($max_weight);
    }

    public function add_item($item_weight, $item_data, $quantity)
    {
        $this->pack_obj->add_item($item_weight, $item_data, $quantity);
    }

    public function pack_items()
    {
        $this->pack_obj->pack_items();
        return $this->get_result();
    }

    public function get_packable_items()
    {
        return $this->pack_obj->get_packable_items();
    }

    public function get_result()
    {
        return $this->pack_obj->get_result();
    }
}
