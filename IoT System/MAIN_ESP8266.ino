//Include the needed library, we will use softer serial communication with the ESP8266
#include <SoftwareSerial.h>
#include <avr/power.h>

//LCD config
#include <Wire.h> 
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include <TinyGPS++.h>
#include <MQ2.h>

//Define the used
#define SEALEVELPRESSURE_HPA (1013.25)
#define BAUD_RATE 9600
#define ESP8266_RX 10  //Connect the TX pin from the ESP to this RX pin of the Arduino
#define ESP8266_TX 11  //Connect the TX pin from the Arduino to the RX pin of ESP
#define BME_SCK 12     //Connect to Serial Clock pin 21 of Arduino
#define BME_SDA 13     //Connect to Serial Data pin 20 of arduino
#define GPS_RX 50
#define GPS_TX 51
#define PMA A0 
#define PMD 44
int MQ1 = A1 ;
int pin_MQ2 = A2 ;
int MQ3 = A3 ;
int MQ4 = A4 ;
int MQ5 = A5 ;
int MQ6 = A6 ;
int MQ7 = A7 ;
int MQ8 = A8 ;
int MQ9 = A9 ;
 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////Variables you must change according to your values/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Add your data: SSID + KEY + host + location + id + password
//////////////////////////////////////////////
const char SSID_ESP[] = "Redmi Note 3";         //Give EXACT name of your WIFI
const char SSID_KEY[] = "sahil@123";            //Add the password of that WIFI connection
const char* host = "airpollution.epizy.com";    //Add the host without "www" Example: electronoobs.com
String NOOBIX_id = "1";                         //This is the ID you have on your database.
String NOOBIX_password = "12345";               //Add the password from the database, also maximum 5 characters and only numerical values
String location_url = "/data.php?id=";          //location of your PHP file on the server. In this case the index.php is directly on the first folder of the server
                                                //If you have the files in a different folder, add thas as well, Example: "/ESP/TX.php?id="     Where the folder is ESP 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




//Used variables in the code
String url = "";
String URL_withPacket = "";    
unsigned long multiplier[] = {1,10,100,1000,10000,100000,1000000,10000000,100000000,1000000000};
//MODES for the ESP
const char CWMODE = '1';//CWMODE 1=STATION, 2=APMODE, 3=BOTH
const char CIPMUX = '1';//CWMODE 0=Single Connection, 1=Multiple Connections
float voMeasured  = 0.0;
float calcVoltage = 0.0;
float dustDensity = 0.0;


//Define the used functions later in the code, thanks to Kevin Darrah, YT channel:  https://www.youtube.com/user/kdarrah1234
boolean setup_ESP();
boolean read_until_ESP(const char keyword1[], int key_size, int timeout_val, byte mode);
void timeout_start();
boolean timeout_check(int timeout_ms);
void serial_dump_ESP();
boolean connect_ESP();
void send_to_server_1(float sent_MQ1, float sent_MQ2_lpg,float sent_MQ2_co,float sent_MQ2_smoke,float sent_MQ3,
                      float sent_MQ4,float sent_MQ5,float sent_MQ6,float sent_MQ7,float sent_MQ8,float sent_MQ9,
                      float sent_BME_temp,float sent_BME_press,float sent_BME_alt,float sent_BME_humid,
                      double sent_GPS_lon,double sent_GPS_lat,float sent_GPS_alt,float sent_PMA);
void connect_webhost();
unsigned long timeout_start_val;
char scratch_data_from_ESP[20];//first byte is the length of bytes
char payload[200];
byte payload_size=0, counter=0;
char ip_address[16];


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//Variable to SEND to the DATABASE
float sent_MQ1 = 0.0;
float sent_MQ2_lpg   = 0.0;
float sent_MQ2_co    = 0.0;
float sent_MQ2_smoke = 0.0;
float sent_MQ3 = 0.0;
float sent_MQ4 = 0.0;
float sent_MQ5 = 0.0;
float sent_MQ6 = 0.0;
float sent_MQ7 = 0.0;
float sent_MQ8 = 0.0;
float sent_MQ9 = 0.0;

float sent_BME_temp  = 0.0;
float sent_BME_press = 0.0;
float sent_BME_alt   = 0.0;
float sent_BME_humid = 0.0;

double sent_GPS_lon = 0.0;
double sent_GPS_lat = 0.0;
float sent_GPS_alt = 0.0;

float sent_PMA = 0.0;


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
 
//DEFINE KEYWORDS HERE
const char keyword_OK[] = "OK";
const char keyword_Ready[] = "Ready";
const char keyword_no_change[] = "no change";
const char keyword_blank[] = "#&";
const char keyword_ip[] = "192.";
const char keyword_rn[] = "\r\n";
const char keyword_quote[] = "\"";
const char keyword_carrot[] = ">";
const char keyword_sendok[] = "SEND OK";
const char keyword_linkdisc[] = "Unlink";

const char keyword_MQ1[] = "MQ1";
const char keyword_MQ2_LPG[] = "PG";
const char keyword_MQ2_CO[] = "CO";
const char keyword_MQ2_SMOKE[] = "SM";
const char keyword_MQ3[] = "MQ3";
const char keyword_MQ4[] = "MQ4";
const char keyword_MQ5[] = "MQ5";
const char keyword_MQ6[] = "MQ6";
const char keyword_MQ7[] = "MQ7";
const char keyword_MQ8[] = "MQ8";
const char keyword_MQ9[] = "MQ9";
const char keyword_BME1[] = "BME1";       //Temprature
const char keyword_BME2[] = "BME2";       //Pressure
const char keyword_BME3[] = "BME3";       //Altitude
const char keyword_BME4[] = "BME4";       //Humidity
const char keyword_GPS_LON[] = "LN";
const char keyword_GPS_LAT[] = "LT";
const char keyword_GPS_ALT[] = "AL";
const char keyword_PMA[] = "PMA";
const char keyword_doublehash[] = "##";


SoftwareSerial ESP8266(ESP8266_RX, ESP8266_TX);// rx tx
SoftwareSerial gpsSerial(GPS_RX, GPS_TX);
Adafruit_BME280 bme;
TinyGPSPlus gps;
MQ2 mq2(pin_MQ2);

void setup(){//        SETUP     START

  //Pin Modes for ESP TX/RX
  pinMode(ESP8266_RX, INPUT);
  pinMode(ESP8266_TX, OUTPUT);
  
  pinMode(MQ1, INPUT);
  pinMode(pin_MQ2, INPUT);
  pinMode(MQ3, INPUT);
  pinMode(MQ4, INPUT);
  pinMode(MQ5, INPUT);
  pinMode(MQ6, INPUT);
  pinMode(MQ7, INPUT);
  pinMode(MQ8, INPUT);
  pinMode(MQ9, INPUT);

  pinMode(BME_SCK, INPUT);
  pinMode(BME_SDA, INPUT);

  pinMode(GPS_RX, INPUT);
  pinMode(GPS_TX, OUTPUT);
  
  pinMode(PMA, INPUT);
  pinMode(PMD, OUTPUT);
  digitalWrite(PMD, HIGH);

  
  

  
  ESP8266.begin(BAUD_RATE);//default baudrate for ESP
  ESP8266.listen();//not needed unless using other software serial instances
  bme.begin();
  gpsSerial.begin(BAUD_RATE);
  mq2.begin();
  Serial.begin(BAUD_RATE); //for status and debug
  
  delay(5000);//delay before kicking things off
  setup_ESP();//go setup the ESP 
 
}




void loop(){

  sent_MQ1 = analogRead(MQ1);
  sent_MQ2_lpg   = mq2.readLPG();
  sent_MQ2_co    = mq2.readCO();
  sent_MQ2_smoke = mq2.readSmoke();
  sent_MQ3 = analogRead(MQ3);
  sent_MQ4 = analogRead(MQ4);
  sent_MQ5 = analogRead(MQ5);
  sent_MQ6 = analogRead(MQ6);
  sent_MQ7 = analogRead(MQ7);
  sent_MQ8 = analogRead(MQ8);
  sent_MQ9 = analogRead(MQ9);
  
  // BME280 READ
  sent_BME_temp  = bme.readTemperature();
  sent_BME_press = bme.readPressure() / 100.0F;
  sent_BME_alt   = bme.readAltitude(SEALEVELPRESSURE_HPA);
  sent_BME_humid = bme.readHumidity();
  
  // GPS READ
  gpsSerial.listen();
  if (gpsSerial.available() > 0){
    if (gps.encode(gpsSerial.read())){
      if (gps.location.isValid()){
          
          sent_GPS_lon = gps.location.lng();
          sent_GPS_lat = gps.location.lat();
          sent_GPS_alt = gps.altitude.meters();
          
      }
    }
  }
  ESP8266.listen();
  
  // PM2.5 Dust Density calc
  digitalWrite(PMD, LOW);                 // power on the LED
  delayMicroseconds(280);
  voMeasured = analogRead(PMA);           // read the dust value
  delayMicroseconds(40);
  digitalWrite(PMD, HIGH);                // turn the LED off
 
  calcVoltage = voMeasured * (5/ 1024.0);            // recover voltage     //0 - 5V mapped to 0 - 1023 integer values
  dustDensity = (0.17 * calcVoltage - 0.1) * 1000.0;
  sent_PMA    = dustDensity;
  
  send_to_server_1(sent_MQ1,  sent_MQ2_lpg, sent_MQ2_co, sent_MQ2_smoke, sent_MQ3,
                   sent_MQ4, sent_MQ5, sent_MQ6, sent_MQ7, sent_MQ8, sent_MQ9,
                   sent_BME_temp, sent_BME_press, sent_BME_alt, sent_BME_humid,
                   sent_GPS_lon, sent_GPS_lat, sent_GPS_alt, sent_PMA);  

  digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
  delay(1000);                       // wait for a second
  digitalWrite(LED_BUILTIN, LOW);    // turn the LED off by making the voltage LOW
  delay(5000);

}//End of the main loop
