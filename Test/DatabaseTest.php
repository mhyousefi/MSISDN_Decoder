<?php

use PHPUnit\Framework\TestCase;

require_once ('../Entities/Database.php');
require_once ('../Entities/Subscriber.php');

class DatabaseTest extends TestCase{
    public function test_case(){
        $DB = new Database("../Data/country_names_dial_codes_identifiers.json", "../Data/Iranian_carriers_info.json");

        $this->assertEquals("IR", ($DB->find_subscriber("989121234567"))->country_ID);
        $this->assertEquals("98", ($DB->find_subscriber("989121234567"))->country_dial_code);
        $this->assertEquals("MCI", ($DB->find_subscriber("989121234567"))->MNO_ID);
        $this->assertEquals("1234567", ($DB->find_subscriber("989121234567"))->subsc_num);

        $this->assertEquals("IR", ($DB->find_subscriber("989361234567"))->country_ID);
        $this->assertEquals("98", ($DB->find_subscriber("989361234567"))->country_dial_code);
        $this->assertEquals("MTN Irancell", ($DB->find_subscriber("989361234567"))->MNO_ID);
        $this->assertEquals("1234567", ($DB->find_subscriber("989361234567"))->subsc_num);

        $this->assertEquals("IR", ($DB->find_subscriber("989211234567"))->country_ID);
        $this->assertEquals("98", ($DB->find_subscriber("989211234567"))->country_dial_code);
        $this->assertEquals("Rightel", ($DB->find_subscriber("989211234567"))->MNO_ID);
        $this->assertEquals("1234567", ($DB->find_subscriber("989211234567"))->subsc_num);

        $this->assertEquals("CA", ($DB->find_subscriber("12481234567"))->country_ID);
        $this->assertEquals("1", ($DB->find_subscriber("12481234567"))->country_dial_code);

        $this->assertEquals("SI", ($DB->find_subscriber("38611234567"))->country_ID);
        $this->assertEquals("386", ($DB->find_subscriber("38611234567"))->country_dial_code);
    }
}

?>