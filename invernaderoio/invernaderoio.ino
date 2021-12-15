#include <WiFi.h>
#include <PubSubClient.h>
#include "DHT.h"
const char* ssid     = "AXS_2.4G_Dta3hQ";
const char* password = "Pq6mRRce";

//variables de conexion mqtt

const char *mqtt_server = "iotinvernadero.ml";
const int mqtt_port = 1883;
const char *mqtt_user = "david";
const char *mqtt_pass = "david";

WiFiClient espClient;
PubSubClient client(espClient);

//DHT
#define DHTPIN 15
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);
//variable de mensajes
long lastMsg = 0;
char msg[25];
int led = 5;
int vent = 12;
int bomba = 23;
int rainPin = A3;
int VALOR;  
int hume;
//***********
//* DECLARACION FUNCIONES *
//***********
void setup_wifi();
void callback(char* topic, byte* payload, unsigned int length);
void reconnect();

void setup() {

  pinMode(led, OUTPUT);
  pinMode(bomba, OUTPUT);
  pinMode(vent, OUTPUT);
  pinMode(rainPin, INPUT);
  Serial.begin(115200);
  dht.begin();
  setup_wifi();
  client.setServer(mqtt_server, mqtt_port);
  client.setCallback(callback);
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }

  client.loop();
  //DHT
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  int sensorValue = analogRead(rainPin);
  hume = map(sensorValue, 0 ,4095 , 100, 0);
  
  VALOR = analogRead(A0);
//envio de mensajes 
  long now = millis();
  if (now - lastMsg > 500){
    lastMsg = now;
    String to_send = String(t) + "," + String(h) + "," + String(hume)+ "," + String(VALOR);
    to_send.toCharArray(msg, 25);
    Serial.print("Publicamos mensaje -> ");
    Serial.println(msg);
    client.publish("datos", msg);
  }
 
}



//***********
//*    CONEXION WIFI      *
//***********
void setup_wifi(){
  delay(10);
  // Nos conectamos a nuestra red Wifi
  Serial.println();
  Serial.print("Conectando a ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("Conectado a red WiFi!");
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());
}



void callback(char* topic, byte* payload, unsigned int length){
  String incoming = "";
  Serial.print("Mensaje recibido desde -> ");
  Serial.print(topic);
  Serial.println("");
  for (int i = 0; i < length; i++) {
    incoming += (char)payload[i];
  }
  incoming.trim();
  Serial.println("Mensaje -> " + incoming);

  if ( incoming == "on") {
    digitalWrite(led, HIGH);
    digitalWrite(vent, HIGH);
   
  } else if ( incoming == "off")  {
    digitalWrite(led, LOW);
    digitalWrite(vent, LOW);
 
  } 
    if ( incoming == "1") {
    digitalWrite(bomba, HIGH);
   
  } else if(incoming == "0") {
    digitalWrite(bomba, LOW);
 
  }
  
}

  
void reconnect() {

  while (!client.connected()) {
    Serial.print("Intentando conexión Mqtt...");
    // Creamos un cliente ID
    String clientId = "esp32_";
    clientId += String(random(0xffff), HEX);
    // Intentamos conectar
    if (client.connect(clientId.c_str(),mqtt_user,mqtt_pass)) {
      Serial.println("Conectado!");
      // Nos suscribimos
      client.subscribe("ventilador");
      client.subscribe("bomba");
    } else {
      Serial.print("falló :( con error -> ");
      Serial.print(client.state());
      Serial.println(" Intentamos de nuevo en 5 segundos");

      delay(5000);
    }
  }
}
