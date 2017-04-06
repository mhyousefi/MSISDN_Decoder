<?php
/**
 * Created by PhpStorm.
 * User: Hossein
 * Date: 4/5/17
 * Time: 10:24 PM
 */

define("country_info_file_name", "../Data/country_names_dial_codes_identifiers.json");
define("IR_Carriers_file_name", "../Data/Iran_operator_info.json");

require ('../vendor/autoload.php');
require_once('../Entities/NumbersDB.php');
require_once('../Entities/Subscriber.php');

use JsonRPC\Server;

$server = new Server();

/*
* Creating an instance of the NumbersDB class
* which once reads from the two JSON files and
* creates two JSON objects inside it for further operations
*/
$Numbers_Database = new NumbersDB(country_info_file_name, IR_Carriers_file_name);

$server->getProcedureHandler()
	// Defining the procedure that is remotely called using a curl command from the server
    ->withCallback('find_subsc', function (string $msisdn) use ($Numbers_Database){
        $subsc = $Numbers_Database->find_subscriber($msisdn);
        if ($subsc == NULL)
            throw new InvalidArgumentException("Invalid MSISDN");
        return $subsc;
    })
;

echo $server->execute();