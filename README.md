# IoT-Based-Complete-AQI-System-


[Link To Live Project](http://airpollution.epizy.com/newpage1.php)
***
IOT Based Air Pollution Monitoring &amp; Forecasting System
## Modules
1. [Pollution Sensing Device](#IoT)
2. [AQI Monitoring Website](#website)
3. [Forecasting using ML](#ml)

## Functionalities
***
![Image text](https://example.com)

<a name="IoT"></a>
### IOT based Air Pollution Sensing Device
1. Arduino (Mega 2560)
2. Pollution Sensors
3. Paticulate Matter Sensor
4. BME 280 Sensor
5. Geological Sensor
6. Wifi MCU (ESP8266)
7. Alert bell
8. Arduino Setup Libraries

#### Details
1. **Arduino (Mega 2560)** 
    * ATmega2560 based microcontroller for connecting, processing and operating with differrent sensors. 
    * Processing the inputs from sensors and provide internal plus external communication.
2. **Pollution Sensors** 
    * Various sensors for sensing Pollution.
3. **Paticulate Matter Sensor**
    * For sensing suspended particulate matters in air i.e. (PM2.5 and PM10).
4. **BME 280 Sensor** 
    * For sensing Temprature, Pressure, Humidity and Altitude.
5. **Geological Sensor**  
    * GPS sensor for sensing the location of the device.
6. **Wifi MCU (ESP8266)** 
    * Making connection with internet.
    * Communicating with website.
    * Sending ensors data to the website.
7. **Alert Bell** 
    * For making Alerts Higher AQI levels.
8. **Arduino Setup Libraries**
    * Libraries forsettingv up sensors with arduino.
 
<a name="website"></a>
### AQI Monitoring Website
***
1. Dashboard
2. Monthly and Daily AQI Monitoring
3. Daily and Hourly AQI Forecasting 
4. Pollution history
5. AQI Alerting and Precaution

#### Details
1. **Dashboard** 
    * For watching the continuous report of all the Sensors
2. **Monthly and Daily AQI Monitoring** 
    * Watching Monthly report of current month AQI.
    * Watching Hourly report of same day.
3. **Daily and Hourly AQI Forecasting** 
    * Seeing next 7 day AQI forecast.
    * Seeing next 24 hours forecast.
4. **Pollution history** 
    * Graphical repersantion of historical data based on selected Month or Day
5. **AQI Alerting and Precaution**
    * Provides alert on website whenever AQI level crosses the limit.
    * Provides consequences and precaution about the AQI levels.
 
<a name="ml"></a>
### Forecasting AQI
***
1. Collecting Dataset
2. Analysing Dataset
3. Training Models using ML
4. Forecasting Time-Series data


#### Details
1. **Collecting Dataset** 
    * Collecting Dataset from the website database of atlest 6 months.
2. **Analysing Dataset** 
    * Exploratory data analysis on the dataset.
    * Wrangling and Preparing the Dataset.
    * Time-windowing the Dataset for time series data forecasting.
3. **Training Models using ML** 
    * Creating various Machine Learning models 
    * Applying various techniques to fit and forecast the data.
    * Comparing Various Designed Models
4. **Forecasting Time-Series data**
    * Finally using the best model to forecast AQI.

## Technologies
***
### A list of technologies used within the project:
**For Setting Up Iot Device**
* [Arduino](https://example.com): Version 12.3 
* [C](https://example.com): Version 12.3 
* [C++](https://example.com): Version 12.3 



**For Designing Website**
* [PHP](https://example.com): Version 12.3 
* [Javascript](https://example.com): Version 2.34
* [CSS](https://example.com): Version 1234
* [BootsTrap](https://example.com): Version 1234
* [MySQL](https://example.com): Version 1234
* [phpMyAdmin](https://example.com): Version 1234
* [Rest API](https://example.com): Version 12.3 


**For Forecasting**
* [Python](https://example.com): Version 12.3 
* [Machine Learning](https://example.com): Version 12.3 
* [Deep Learning](https://example.com): Version 12.3 
* [Anaconda](https://example.com): Version 12.3 
