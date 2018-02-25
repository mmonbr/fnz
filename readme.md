#Prueba F1nizens

```
docker-compose up
docker-compose exec -u application webserver bash -c "cd /var/www; composer install"
docker-compose exec -u application webserver bash -c "cd /var/www; bin/phpunit"
```

#Notas
- En LogCommunicationRepository podría haber utilizado una factoría para construir las entidades pero no estoy seguro de que sea su responsabilidad. En cualquier caso dejo la interfaz en Domain\Communications.
- Utilizo Traits para implementar el método Outgoing en las distintas comunicaciones.
- En los endpoints de la API se puede filtrar por *type:* (sms|call) y *direction*: (incoming|outgoing).
- He dejado algunos métodos sin implementar en Domain\ValueObject\PhoneNumber como ejemplo de qué podría hacer el VO.
- Quizás lo de Incoming/Outgoing estaba de más y algo "overengineeried".

¡Espero que os guste!

#Ejemplos respuestas API

```
$ curl -i http://f1nizens.local/api/communications/611222333
```
```
HTTP/1.1 200 OK
Server: nginx/1.10.3
Content-Type: application/json
Connection: keep-alive
Cache-Control: no-cache, private
```
```json
[
   {
      "type":"call",
      "origin":611222333,
      "destination":600999888,
      "direction":"outgoing",
      "contact":{
         "name":"Pepe"
      },
      "date":{
         "date":"2016-01-01 20:52:03.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":142
   },
   {
      "type":"sms",
      "origin":700111222,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Movistar"
      },
      "date":{
         "date":"2016-01-02 18:01:30.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   },
   {
      "type":"call",
      "origin":911222333,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Mama"
      },
      "date":{
         "date":"2016-01-03 19:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":142
   },
   {
      "type":"call",
      "origin":911444555,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Rodrigo"
      },
      "date":{
         "date":"2016-01-04 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":230
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-05 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":501
   },
   {
      "type":"sms",
      "origin":611222333,
      "destination":1420,
      "direction":"outgoing",
      "contact":{
         "name":"Unknown"
      },
      "date":{
         "date":"2016-01-05 22:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Javi"
      },
      "date":{
         "date":"2016-01-06 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":110
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-06 20:05:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":501
   },
   {
      "type":"sms",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-06 22:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   },
   {
      "type":"call",
      "origin":911222333,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Mama"
      },
      "date":{
         "date":"2016-01-07 19:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":13034
   }
]
```

```
curl -i http://f1nizens.local/api/communications/611222333/calls
```
```
HTTP/1.1 200 OK
Server: nginx/1.10.3
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
```
```json
[
   {
      "type":"call",
      "origin":611222333,
      "destination":600999888,
      "direction":"outgoing",
      "contact":{
         "name":"Pepe"
      },
      "date":{
         "date":"2016-01-01 20:52:03.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":142
   },
   {
      "type":"call",
      "origin":911222333,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Mama"
      },
      "date":{
         "date":"2016-01-03 19:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":142
   },
   {
      "type":"call",
      "origin":911444555,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Rodrigo"
      },
      "date":{
         "date":"2016-01-04 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":230
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-05 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":501
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Javi"
      },
      "date":{
         "date":"2016-01-06 20:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":110
   },
   {
      "type":"call",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-06 20:05:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":501
   },
   {
      "type":"call",
      "origin":911222333,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Mama"
      },
      "date":{
         "date":"2016-01-07 19:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      },
      "duration":13034
   }
]
```


```
curl -i http://f1nizens.local/api/communications/611222333/sms
```
```
HTTP/1.1 200 OK
Server: nginx/1.10.3
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
```
```json
[
   {
      "type":"sms",
      "origin":700111222,
      "destination":611222333,
      "direction":"incoming",
      "contact":{
         "name":"Movistar"
      },
      "date":{
         "date":"2016-01-02 18:01:30.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   },
   {
      "type":"sms",
      "origin":611222333,
      "destination":1420,
      "direction":"outgoing",
      "contact":{
         "name":"Unknown"
      },
      "date":{
         "date":"2016-01-05 22:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   },
   {
      "type":"sms",
      "origin":611222333,
      "destination":633666777,
      "direction":"outgoing",
      "contact":{
         "name":"Jose"
      },
      "date":{
         "date":"2016-01-06 22:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   }
]
```

```
curl -i http://f1nizens.local/api/communications/611222333/communications/1420
```
```
HTTP/1.1 200 OK
Server: nginx/1.10.3
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
```
```json
[
   {
      "type":"sms",
      "origin":611222333,
      "destination":1420,
      "direction":"outgoing",
      "contact":{
         "name":"Unknown"
      },
      "date":{
         "date":"2016-01-05 22:00:00.000000",
         "timezone_type":3,
         "timezone":"UTC"
      }
   }
]
```

