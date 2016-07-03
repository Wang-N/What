#define HASH C4CA4238A0B923820DCC509A6F75849B     //此设备唯一Hash
#define LOCA 666  //设备位置编号
#define TEMPE_PORT A0       //LM35DZ温度传感器端口

float tempe;

void setup()
{

  Serial.begin(9600);
}
void loop()
{
  
  if (Tempe() == 0) {
    Sub(0);
  }
  delay(1000);
}

void Sub(int code) {
  
  Serial.print(HASH);
  Serial.print(tempe);
  Serial.print(LOCA);
  Serial.println(code);
  
}

int Tempe() {
  int ret;
  int n = analogRead(TEMPE_PORT);   //获取TEMPE_PORT电压值
  int temp = n * (5.0 / 1023.0 * 100);

  if (temp >= 0.0 && temp <= 100.0) {
    tempe = temp;
    ret = 0;
  } else {
    ret = 1;
  }

  return ret;
}     //ret为0正常，为1异常，温度数据舍弃

