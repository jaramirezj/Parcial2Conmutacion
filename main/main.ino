#include <DHT.h>

#define DHTTYPE DHT11 
#define dht_dpin 0
DHT dht(dht_dpin, DHTTYPE);
void setup() {
  dht.begin();
  Serial.begin(9600);
}

void loop() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  Serial.print("T:");
  Serial.print(t);
   Serial.print(" H:");
  Serial.println(h);
  delay(1000);
}
