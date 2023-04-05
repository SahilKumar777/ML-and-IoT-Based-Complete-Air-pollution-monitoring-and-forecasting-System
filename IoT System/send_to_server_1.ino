void send_to_server_1(float sent_MQ1, float sent_MQ2_lpg,float sent_MQ2_co,float sent_MQ2_smoke,float sent_MQ3,
                      float sent_MQ4,float sent_MQ5,float sent_MQ6,float sent_MQ7,float sent_MQ8,float sent_MQ9,
                      float sent_BME_temp,float sent_BME_press,float sent_BME_alt,float sent_BME_humid,
                      double sent_GPS_lon,double sent_GPS_lat,float sent_GPS_alt,float sent_PMA){
//we have changing variable here, so we need to first build up our URL packet
/*URL_withPacket = URL_webhost;//pull in the base URL
URL_withPacket += String(unit_id);//unit id value
URL_withPacket += "&sensor=";//unit id 1
URL_withPacket += String(sensor_value);//sensor value
URL_withPacket += payload_closer;*/

url = location_url;
url += NOOBIX_id;
url += "&pw=";
url +=  NOOBIX_password;//sensor value
url += "&MQ1=" +  String(sent_MQ1);          //sensor value
url += "&PG=" +  String(sent_MQ2_lpg);      //sensor value
url += "&CO=" +  String(sent_MQ2_co);       //sensor value
url += "&SM=" +  String(sent_MQ2_smoke);    //sensor value
url += "&MQ4=" +  String(sent_MQ4);          //sensor value
url += "&MQ7=" +  String(sent_MQ7);          //sensor value
url += "&MQ8=" +  String(sent_MQ8);          //sensor value
url += "&BME1=" +  String(sent_BME_temp);     //sensor value
url += "&BME2=" +  String(sent_BME_press);    //sensor value
url += "&BME3=" +  String(sent_BME_alt);      //sensor value
url += "&BME4=" +  String(sent_BME_humid);    //sensor value
url += "&LT=" +  String(sent_GPS_lat);      //sensor value
url += "&LN=" +  String(sent_GPS_lon);      //sensor value
url += "&AL=" +  String(sent_GPS_alt);      //sensor value
url += "&PMA=" +  String(sent_PMA);          //sensor value


URL_withPacket = ""; 

URL_withPacket = (String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");




/*
URL_withPacket += "Host: www.electronoobs.com\r\n";  
URL_withPacket += "Connection: close\r\n\r\n";  
  */
  /// This builds out the payload URL - not really needed here, but is very handy when adding different arrays to the payload
  counter=0;//keeps track of the payload size
  payload_size=0;
  for(int i=0; i<(URL_withPacket.length()); i++){//using a string this time, so use .length()
    payload[payload_size+i] = URL_withPacket[i];//build up the payload
    counter++;//increment the counter
  }//for int
  payload_size = counter+payload_size;//payload size is just the counter value - more on this when we need to build out the payload with more data
    //for(int i=0; i<payload_size; i++)//print the payload to the ESP
    //Serial.print(payload[i]);   


   
  if(connect_ESP()){//this calls 'connect_ESP()' and expects a '1' back if successful
  //nice, we're in and ready to look for data
  //first up, we need to parse the returned data  _t1123##_d15##_d210##
  Serial.println("connected ESP");  
  }//connect ESP


}//connect web host
