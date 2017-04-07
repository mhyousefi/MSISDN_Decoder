# MSISDN_Decoder

## How to use it:
If you have Docker, enter the following commands:

    $ docker pull mhyousefi/msisdn-decoder
    $ docker run -d -p <PORT>:80 --name msisdn-decoder-1 msisdn-decoder
    $ curl -d "{\"jsonrpc\": \"2.0\", \"method\": \"find_subsc\", \"id\": 486782327, \"params\": [\"<PHONE_NUMBER>\"]}" http://localhost:<PORT>/rpcAPI/

Otherwise clone the source code, build and run the container, and use the following command:

    $ curl -d "{\"jsonrpc\": \"2.0\", \"method\": \"find_subsc\", \"id\": 486782327, \"params\": [\"<PHONE_NUMBER>\"]}" http://localhost:<PORT>/rpcAPI/


## How it works:
This application takes an MSISDN, decodes the number using two JSON files in /Data directory, and returns the following:
* country dialing code
* country identifier as defined with ISO 3166-1-alpha-2
* subscriber number
* MNO identifier

## Side notes
* Due to limitations on data available to the applications, the last two attributes are decoded only for mobile phone numbers from Iran.
* It is clear that a database (MySQlLi) is preferred in such programs. However, due to the small scope of the program, two JSON files containing relevant info are used.

## On MSISDN
Mobile Subscriber Integrated Services Digital Network (MSISDN) refers to the mobile phone number of the participating customer. 

MSISDN excludes the prefixes + or 00. 
For mobile phones, MSISDN = CC + network prefix + SN where
CC = country dialing code
SN = subscriber number

For example for USA: 12481234567 (Country Code = 1, network prefix = 248, number = 1234567)

Mobile Network Operator (MNO) refers to the company (e.g. NT&T, Verizon, etc) which administers and runs a single mobile network. Each network prefix (not considering number portability as is not in this application) maps to one mobile carrier.
