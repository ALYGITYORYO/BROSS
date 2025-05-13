<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.factura.com/api/v4/cfdi40/create',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
     "Receptor" : {
        "UID": "681fa07697651"
      },
      "TipoDocumento":"factura",
      "Conceptos": [{
        "ClaveProdServ": "81112101",
        "Cantidad":1,
        "ClaveUnidad":"E48",
        "Unidad": "Unidad de servicio",
        "ValorUnitario": 229.90,
        "Descripcion": "Desarrollo a la medida",
        "ObjetoImp":"02",
         "Impuestos":{
            "Traslados":[
               {
                  "Base": 229.90,
                  "Impuesto":"002",
                  "TipoFactor":"Tasa",
                  "TasaOCuota":"0.16",
                  "Importe":36.784
               }
            ],
            "Locales":[
                {
                    "Base": 229.90,
                    "Impuesto": "ISH",
                    "TipoFactor": "Tasa",
                    "TasaOCuota": "0.03",
                    "Importe": 6.897

                }
            ]
         }
      }],
      "UsoCFDI": "P01",
      "Serie": 17317,
      "FormaPago": "03",
      "MetodoPago": "PUE",
      "Moneda": "MXN",
      "EnviarCorreo": false
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'F-PLUGIN:9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
    'F-Api-Key:JDJ5JDEwJGJoanluQ25KRjJOMERFb1N1MURYN3VYYk1mQTlOZkxoREhlSkZwcDM4b2xmU2dLbGdQSFR5',
    'F-Secret-Key:JDJ5JDEwJG9uSE5xZEJUQnVEbWtDZzRCcGVja2VnVmtNS0VqWC83U0NSc2RCV0g1L2NjcGRIREJSVEtl'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

