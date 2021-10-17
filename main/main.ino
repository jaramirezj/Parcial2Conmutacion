#include <ESP8266WiFi.h>
#include <DHT.h>

const char* ssid = "";
const char* password = "";
const char* host = "192.168.1.29";
const int port =80;
const int watchdog = 5000;
#define DHTTYPE DHT11 
#define dht_dpin 0
DHT dht(dht_dpin, DHTTYPE);

unsigned long tInicial;
unsigned long tActual;
float tempT = 0;
float tempH = 0;
float temperatura;
float humedad;

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("/n Conectado");
  dht.begin();
}

void enviarDatos(){
  Serial.print("T:");
  Serial.print(temperatura);
   Serial.print(" H:");
  Serial.println(humedad);
  tempT = 0;
  tempH = 0;
}

void loop() {
  tInicial = millis();
  tActual = millis();
  while(tActual - tInicial <= 30000){
    
    tempT += dht.readTemperature();
    tempH += dht.readHumidity();
    delay(1000);
    tActual = millis();
  }
  temperatura = tempT / 30;
  humedad = tempH / 30;
  enviarDatos();
}
