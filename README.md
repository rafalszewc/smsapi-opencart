# smsapi-opencart
Module which allows you to send SMS to clients of your shop

## Installation
0. Upload all of the content from the "upload" directory to the **root directory** of your shop
0. In the administrator panel, go to: **Extensions > Modules > SMSAPI** and click Install

## Configuration
0. Go to: **Extensions > Modules > SMSAPI** and click Edit
0. Select Settings tab and click "Connect"
0. Enter **username** and password (**password must be in MD5** encryption which can be found in SMSAPI panel in API Settings > API Password > Show API password in MD5)
0. Options:
  * **Sender name** - choose sender name that will be displayed on recipient's phone.
  * **Replace special characters** - if message contains Unicode UTF-8 characters they will be replaced with standard chars (e.g. (ê->e, ý->y, α->A, π->Π etc.).
  * **Send with highest priority** - message will be sent with highest priority. ATTENTION: Fast message tariff fee applies. (1.5x per SMS price).
  * **Owner's number** - phone number of owner to which SMS about new order will be sent (if option selected).
  * **Inform shop owner about new order** - decides if owner will receive SMS about new order.
  * **Inform client about order status change** - if order status will change inform clietn about it by SMS.
