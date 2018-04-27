#include <Servo.h>
#include <ESP8266WiFi.h>

Servo myservo;

char data[15];
String S,d;
int buz = 5;
const char* ssid     = "pattanayaks";
const char* password = "basan2@987";
const char* host = "cetproject.ihostfull.com";

void setup() {
  Serial.begin(9600);
  pinMode(buz,OUTPUT);
  delay(100);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.print(".");
    digitalWrite(buz,HIGH);
    delay(200);
    digitalWrite(buz,LOW);
  }
  pinMode(0,OUTPUT);
  pinMode(16,OUTPUT);
  digitalWrite(0 , HIGH);
  pinMode(buz,OUTPUT);
  myservo.attach(2);
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("Netmask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway: ");
  Serial.println(WiFi.gatewayIP());

}

void loop() {
  digitalWrite(0 , HIGH);
  int i=0;

  while(Serial.available() > 0) 
  {
      data[i]=Serial.read();
      i++;
  }

  data[i]='\0';
  
  if(data[0] != '\0')
  {
     if(data[i-1] == '\n')
       data[i-1] = '\0';
       
     S=String(data);
     S.trim();
     
/**** For Debugging Purpose : Print the data recevied in Serial Monitor  ****/     
     Serial.print("I found -");
     Serial.println(S);      
/****  End Of The Debugging Section ****/


/**** Do Your Stuff Here On successful Detection Of the RFID Card ****/
     Serial.print("connecting to ");
    Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  
  String url = "/api/toolapiModified.php?tag=" + String(S);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(500);
/*====================================================*/
  String section="header";
      while(client.available()){
        String line = client.readStringUntil('\r');
        line.trim();
        //Serial.println(line);
        if(line == "status=0"){
          buzz(5);
          }else if(line == "status=1"){
          mservo();
          }else if(line == "status=2"){
          buzz(3);
          }
        
      }
  /*==========================================================*/ 
  Serial.println();
  Serial.println("closing connection");
  delay(3000);    
/**** End of the WORK On Successful Detection Of card ****/
  }  
  digitalWrite(0 , LOW);
}

void mservo()
{
    int pos;
   //Serial.println("servo");
  for(pos = 0; pos <= 90; pos += 1) // goes from 0 degrees to 180 degrees 
  {                                  // in steps of 1 degree 
    Serial.println();
    myservo.write(pos);              // tell servo to go to position in variable 'pos' 
    //delay(15);                       // waits 15ms for the servo to reach the position 
  } 
  delay(10000);
  for(pos = 90; pos>=0; pos-=1)     // goes from 180 degrees to 0 degrees 
  {                                
    myservo.write(pos);              // tell servo to go to position in variable 'pos' 
    //delay(15);                       // waits 15ms for the servo to reach the position 
  }
}
void buzz(int a){
  for(int i = 0; i < a ; i++){
   delay(200);
   digitalWrite(buz,HIGH);
   delay(200);
   digitalWrite(buz,LOW);
  }
 }
