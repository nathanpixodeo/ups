<?php
namespace UPS\Shipping\Model\WeightBased;

class WeightPackResult
{
            private $errors        =    [];
            private $packed        =    [];
            private $unpacked    =    [];

    public function set_error($errors)
    {
        $this->errors[]        =    $errors;
    }

    public function set_packed_boxes($packages)
    {
        $this->packed        =    $packages;
    }

    public function set_unpacked_items($packages)
    {
        $this->unpacked        =    $packages;
    }

    public function get_errors()
    {
        return $this->errors;
    }

    public function get_packed_boxes()
    {
        return $this->packed;
    }

    public function get_unpacked_items()
    {
        return $this->unpacked;
    }
}
