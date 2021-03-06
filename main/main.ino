#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <DHT.h>

const char* ssid = "UNE_HFC_7BB0";
const char* password = "AAA0BF87";
String receptor = "http://192.168.1.14:80/Parcial2Conmutacion/actualizar.php";//Ruta donde se enviaran los datos


#define pinLluvia 12 // (D6)
#define DHTTYPE DHT11 
#define dht_dpin 0
DHT dht(dht_dpin, DHTTYPE);

unsigned long tInicial;
unsigned long tActual;
float tempT = 0;
float tempH = 0;
float temperatura;
float humedad;
unsigned int lluvia = 0;

void ICACHE_RAM_ATTR actualizarLluvia ();

void setup() {
  Serial.begin(9600);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }
  Serial.println("/n Conectado");
  dht.begin();
  pinMode(pinLluvia, INPUT_PULLUP);
  attachInterrupt(digitalPinToInterrupt(pinLluvia),actualizarLluvia,CHANGE);
  temperatura = dht.readTemperature();
  humedad = dht.readHumidity();
  enviarDatos();
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

void actualizarLluvia(){
  lluvia = digitalRead(pinLluvia);
}

void enviarDatos(){
  WiFiClient client;
  HTTPClient http;
  String datos = "";
  Serial.print("T:");
  Serial.print(temperatura);
  Serial.print(" H:");
  Serial.println(humedad);
  tempT = 0;
  tempH = 0;
  datos = "?temperatura="+String(temperatura)+"&humedad="+String(humedad)+"&lluvia="+String(lluvia); 
  String path = receptor + datos;
  http.begin(client, path.c_str());
  // Send HTTP GET request
  int httpResponseCode = http.GET();
  if (httpResponseCode>0) {
     Serial.print("HTTP Response code: ");
     Serial.println(httpResponseCode);
     String payload = http.getString();
     Serial.println(payload);
  }
  else{
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  http.end();
}
