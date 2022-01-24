Esta funcionalidad está pensada para controlar la fecha de reposición de los productos en un ecommerce.

Partiendo de un campo personalizado en el que se incluye la fecha prevista de reposición del producto, se coge este campo para calcular 
si dicha fecha está próxima, o si por un error en el volcado de datos o un error en la actualización de los productos, esta fecha
no existe, ya ha pasado o quedan más de 365 días para que se cumpla (esta última condición se puede variar en función de las necesidades
del proyecto).

En el primero de los casos, imprimirá por pantalla la fecha prevista de la reposición del producto, con el texto que se desee, junto a 
2 enlaces independientes para que el cliente interesado en el producto pueda escoger entre mandar una consulta por WhatsApp o email 
para obtener más detalles, si así lo deseara.

En la consulta por WhatsApp, se incluye de manera automática un texto estandar que puede ser configurado según las necesidades, además de la
url del producto a consultar, para que el gestor de la tienda sepa de inmediato de qué producto se trata.

En la consulta por correo electrónico, se incluyen de manera automática tanto un asunto personalizado, como un cuerpo del mensaje, también
con la url del producto a consultar.

En el segundo de los casos, se imprimirá el texto deseado, junto a los 2 citados botones. Puesto que no existe fecha prevista de reposición
del producto, o no está dentro de los parámetros predeterminados, no se muestra por pantalla.

