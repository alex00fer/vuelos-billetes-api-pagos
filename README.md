## API Vuelos Ampliada en PHP con mongo

#### Para configurar la BBDD y colección de mongo:
Modificar las propiedades 'db' y 'col' del fichero `dbConnection.php`

### CRUD API
Tiene un único punto de acceso: `/billetes.php`.
Las respuestas siempre incluirán el campo booleano `estado` que indicará si la operación se completo correctamente o no.

________________________________________________________________________

Peticion GET (ver vuelos o buscar vuelos)

```
/billetes.php - VER TODOS
/billetes.php?fecha=2021/02/02&origen=Madrid&destino=Barcelona
/billetes.php?fecha=2021/02/02&origen=Madrid
```

Si hay vuelos que cumplan los criterios

```
{
	estado: true,
	encontrados: 1,
	busqueda: {
		fecha: "2021/02/02"
		origen: "Madrid"
		destino: "Barcelona"
	}
	vuelos: [
		{
			"codigo" : "IB706",
			"origen" : "MADRID",
			"destino" : "BARCELONA",
			"fecha" : "2020-12-17",
			"hora" : "18:50",
			"plazas_totales" : 10,
			"plazas_disponibles" : 8,
			"precio": 350
		}
	]
}
```

Si no hay vuelos que cumplan los criterios
```

{
	estado: true,
	encontrados: 0
}
```

Si hay algún error en la petición o no se ha podido realizar la consulta
```

{
	estado: false,
	mensaje: "No se ha podido realizar la consulta por... (a completar)"
}
```

________________________________________________________________________

Peticion POST (comprar un billete)

Se envía lo siguiente desde el cliente

```
{
	"codigo" : "IB706",
	"dni" : "44556677H",
	"apellido" : "Rodriguez",
    "nombre" : "María",
    "dniPagador" : "44556677H",
    "tarjeta" : "038 0025 5553 5553",
    "pin": 1234
}
```

Si todo ha ido bien, la respuesta será

```
{
	"estado" : true,
	"codigo" : "IB706",
	"origen" : "MADRID",
	"destino" : "BARCELONA",
	"fecha" : "2020-12-17",
	"hora" : "18:50",
    "asiento" : 3,
    "dni" : "44556677H",
    "apellido" : "Rodriguez",
    "nombre" : "María",
    "dniPagador" : "44556677H",
    "tarjeta" : "038 0025 5553 5553",
    "codigoVenta" : "GHJ7766GG",
	"costeBillete" : 350
}
```

Si hay algún error

```
{
	estado: false,
	mensaje: "..."
}
```

_______________________________________________________________________

Petición DELETE - Borrar un billete

```
{
	"codigo" : "IB706",
	"dni" : "44556677H",
	"codigoVenta" : "GHJ7766GG"
}
```

_____________________________________________________________________

Petición PUT - Modificar un billete

```
{
	"codigo" : "IB706",
	"dni" : "44556677H",
	"codigoVenta" : "GHJ7766GG",
	"dni" : "44556677H",
	"apellido" : "Rodriguez",
    "nombre" : "María"
}
```




