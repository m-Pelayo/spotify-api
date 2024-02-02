# Spotify API

- Ejercico para la asignatura de Acceso a Datos 2º DAM

## Introducción

En esta práctica, se creará un proyecto Symfony llamado "spotify-api" para exponer la información de la base de datos de Spotify utilizada durante el curso pasado.

---

***¡Importante!** Este proyecto se realiza sobre dos repositorios Docker: uno para el servidor de Base de Datos y otro que contendra nuestro ORM.*

## Pasos a seguir

##### 1. Clona el repositorio 

```bash
git clone...
```

##### 2. Copiar contenido `.env` a `.env.local` y cambiar parámetros

```bash
cp .env .env.local
```

```bash
DB_USER=""
DB_PASSWORD=""
DB_HOST=""
DB_NAME="spotify"
```

##### 3. Levantar contenedor base de datos y contenedor del ORM

```bash
docker-compose up -d
```

##### 4. Insertar spotify.sql en nuestro servidor de base de datos

```bash
docker exec -it spotifyapi /bin/bash
mysql -u (dueño en contenedor bd) -p(contraseña sin espacio) -h (red repositorio) (nombre esquema) < db/spotify.sql
```

##### 5. Instalar composer

```bash
composer install
```

---

### Endpoints a implementar y métodos HTTP

[Archivo de rutas](https://github.com/SergioGC1/spotify-api/blob/master/config/routes.yaml)

### [USUARIOS 😄](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/UsuarioController.php)

- `/usuarios` *[GET, POST]*
- `/usuario/{id}` *[GET, PUT]*

### [CONFIGURACIONES ⚙️](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/ConfiguracionController.php)

- `/usuarios/{usuario_id}/configuracion` *[GET, PUT]*

### [PODCASTS 🎙️](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/PodcastController.php)

- `/podcasts` *[GET, POST]*
- `/podcast/{id}` *[GET]*
- `/usuario/{id}/podcasts` *[GET]*
- `/usuario/{usuarioId}/podcast/{podcastId}` *[POST, DELETE]*

### [CAPÍTULOS 📖](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/CapituloController.php)

- `/podcast/{id}/capitulos` *[GET]*
- `/podcast/{podcastId}/capitulo/{capituloId}` *[GET]*

### [SUSCRIPCIONES ⭐](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/SuscripcionController.php)

- `/usuario/{id}/suscripciones` *[GET]*
- `/usuario/{usuarioId}/suscripcion/{suscripcionId}` *[GET]*

### [PLAYLISTS 📓](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/PlaylistController.php)

- `/playlists` *[GET]*
- `/playlist/{id}` *[GET]*
- `/usuario/{id}/playlists` *[GET, POST]*
- `/usuario/{usuarioId}/playlist/{playlistId}` *[GET, PUT, DELETE]*

### [CANCIONES 🎶](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/CancionController.php)

- `/canciones` *[GET]*
- `/cancion/{id}` *[GET]*
- `/playlist/{id}/canciones` *[GET]*
- `/playlist/{playlistId}/cancion/{cancionId}` *[POST, DELETE]*

### [ARTISTAS 🎤](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/ArtistaController.php)

- `/artistas` *[GET]*
- `/artista/{id}/albums` *[GET]*
- `/artista/{artistaId}/album/{albumId}` *[GET]*

### [ALBUMS 📚](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/AlbumController.php)

- `/albums` *[GET]*
- `/album/{id}` *[GET]*
- `/album/{id}/canciones` *[GET]*

### [CALIDAD ✅](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/CalidadController.php)

- `/calidades` *[GET]*

### [IDIOMA 👅](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/IdiomaController.php)

- `/idiomas` *[GET]*

### [TIPO DESCARGA 🗂️](https://github.com/SergioGC1/spotify-api/blob/master/src/Controller/TipoDescargaController.php)

- `/tipos-descargas` *[GET]*

## Autores

| [<img src="https://avatars.githubusercontent.com/u/152878194?v=4" width=115><br><sub>Mario Pelayo</sub>](https://github.com/m-Pelayo) |  [<img src="https://avatars.githubusercontent.com/u/113478355?v=4" width=115><br><sub>Sergio Guillem</sub>](https://github.com/SergioGC1) |  [<img src="https://avatars.githubusercontent.com/u/8101959?v=4" width=115><br><sub>Antonio Calabuig</sub>](https://github.com/buig) |
| :---: | :---: | :---: |
| API | API | DB |