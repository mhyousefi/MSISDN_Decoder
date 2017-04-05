<?php

class Database{
    private $country_data_JSON;
    private $Iran_carriers_JSON;

    function __construct($country_data_file_name, $Iran_carriers_data_file_name){
        $countries = file_get_contents($country_data_file_name);
        $IR_carriers = file_get_contents($Iran_carriers_data_file_name);

        $this->country_data_JSON = json_decode($countries);
        $this->Iran_carriers_JSON = json_decode($IR_carriers);
    }

    public function find_subscriber(string $msisdn){
        $country = $this->find_country_info($msisdn);

        //If there is a valid country match in the JSON file:
        if ($country != NULL) {
            $country_ID = $country->code;
            $country_dial_code = $country->dial_code;
            $country_name = $country->name;

            $subsc_num = "";
            $MNO_ID = "";

            if ($country_ID == "IR") {
                $info = $this->extr_MNO_and_subsc_num($msisdn);
                $subsc_num = $info[0];
                $MNO_ID = $info[1];

            }
            return new Subscriber($country_ID, $country_dial_code, $country_name, $subsc_num, $MNO_ID);
        }
        return NULL;
    }

    private function find_country_info(& $msisdn){
        foreach ($this->country_data_JSON as $country){
            if (substr($country->dial_code, 1) == substr($msisdn, 0, strlen($country->dial_code) - 1)){
                $msisdn = substr($msisdn, strlen($country->dial_code) - 1);
                return $country;
            }
        }
        return NULL;
    }

    private function extr_MNO_and_subsc_num($phone_num){
        foreach ($this->Iran_carriers_JSON as $carrier){
            foreach ($carrier->NDC_code as $prefix){
                if ($prefix == substr($phone_num, 0, strlen($prefix))){
                    $MNO_ID = $carrier->operator;
                    $subsc_num = substr($phone_num, strlen($prefix));
                    return [$MNO_ID, $subsc_num];
                }
            }
        }
        return ["", ""];
    }
}
