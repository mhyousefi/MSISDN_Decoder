<?php

class Subscriber{
    public $country_ID = "";
    public $country_dial_code = "";
    public $country_name = "";
    public $subsc_num = "";
    public $MNO_ID = "";

    function __construct($country_ID, $country_dial_code, $country_name, $subsc_num, $MNO_ID) {
        $this->country_ID = $country_ID;
        $this->country_dial_code = $country_dial_code;
        $this->country_name = $country_name;
        $this->subsc_num = $subsc_num;
        $this->MNO_ID = $MNO_ID;
    }
}

?>
