# VHS TEST Application

This repo it's only to show my knowledge of the symfony to the HR and IT departments.
## Requirements
Necesitamos una prueba piloto de un sistema de gestión de una colección de VHS para uno de nuestros productos. Lo queremos mantener separado, así que debemos empezar un nuevo proyecto.
Empezaremos con algo sencillo, sólo queremos poder dar de alta y listar películas. Vamos a necesitar acceder al contenido desde otras aplicaciones, lo que nos requiere exponer una API.
Como base de datos deberás utilizar MariaDB, puedes montarla por separado o incluir la configuración de docker-compose directamente en el proyecto.

Por tanto, este proyecto debe tener 2 secciones:
Endpoint para la obtención del listado de VHS.
Endpoint para la creación de un nuevo VHS. En este punto deberás también obtener datos adicionales sobre la película desde TheMovieDB (explicado más abajo).

Para la obtención de datos desde TheMovieDB simplemente deberás obtener los datos de la película y añadirlos a los datos que llegan al endpoint. Por ejemplo, si el cuerpo de la petición es este:
``{
“name”: “Spider-Man: No Way Home”,
“moviedb_id”: 123
}``

La entidad resultante debería ser algo parecido a esto:
``{
"name": "",
"full_details": {
"adult": false,
"backdrop_path": "/iQFcwSGbZXMkeyKrxbPnwnRo5fl.jpg",
"genre_ids": [
28,
12,
878
],
"id": 634649,
"original_language": "en",
"original_title": "Spider-Man: No Way Home",
"overview": "Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man.",
"popularity": 6120.418,
"poster_path": "/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg",
"release_date": "2021-12-15",
"title": "Spider-Man: No Way Home",
"video": false,
"vote_average": 8.2,
"vote_count": 11355
}
}``

Para obtener los datos debes usar el endpoint de detalles de una película: https://api.themoviedb.org/3/movie/?api_key=<<api_key>>&language=en-US

Nota: El ID de la película en TheMovieDB es parte de lo que se enviará al endpoint para la creación, puedes obtener IDs de películas haciendo una llamada manual al endpoint de películas populares: https://api.themoviedb.org/3/movie/popular?api_key=<<api_key>>&language=en-US&page=1

El objetivo de la prueba es la demostración de conocimientos en Symfony y PHP, por lo que se primará el cuidado de la estructura backend: aplicación de principios SOLID, la correcta separación de servicios y responsabilidades, introducción de interfaces, tolerancia ante fallos, etc.

Puedes usar librerías adicionales a las del framework si lo necesitas, pero deberás cumplir estos requisitos:
PHP 8+
Composer
La última versión estable de Symfony
Testing unitario
La API debe devolver y consumir los datos en formato JSON

Valorable/Opcional:
Uso de herramientas de análisis estático (por ejemplo, PHPStan en modo máximo) y de estilo de código (por ejemplo, PHP CS Fixer en modo @Symfony)
Ofrecer un Swagger/OpenAPI

## Develop
- Mount the base project and the initial functional test
- Add the database layer, with migrations and fixtures
- Extract the logic of the add Films
- Add TheMovieDB API connection

## Next steps
- Add swagger to the API.
- Add JWT token validator to the add data function.
- Extends the data of the TheMovieDB API to different fields.
- API TMDB create interface and model for the responses and data sent

### Notes
- To reduce the time I use only one branch without PR
- I implement only github actions because it's the git server that I'm using.
- 
