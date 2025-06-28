# Tarea 5 - Consumo de APIs con PHP

Este proyecto consiste en una colección de pequeñas aplicaciones desarrolladas en PHP que consumen distintas APIs públicas, como OpenWeather, REST Countries, Unsplash, entre otras. Cada módulo permite al usuario interactuar con una API distinta desde un formulario HTML sencillo.

## 🔧 Tecnologías utilizadas

- PHP
- HTML/CSS
- Bootstrap
- APIs públicas (REST)
  - [OpenWeatherMap](https://openweathermap.org/api)
  - [REST Countries](https://restcountries.com/)
  - [PokeAPI](https://pokeapi.co/)
  - [Unsplash API](https://unsplash.com/developers)
  - [Official Joke API](https://official-joke-api.appspot.com/)
  - [ExchangeRate API](https://exchangerate.host/)

## 📁 Estructura del proyecto

📂 tarea5/
├── 📁 css/
│ └── estilos.css
├── 📁 img/
│ └── imágenes usadas
├── 📁 view/
│ └── diferentes vistas: clima.php, paises.php, pokemon.php, chistes.php, etc.
├── header.php
├── footer.php
├── acera.php
└── index.php

## 🚀 Funcionalidades
- **Prediccion de genero**: Intenta adivinar el genero segun el nombre.
- **Prediccion de edad**: Intenta adivinar la edad segun el nombre.
- **Universidades del mundo**: Busca todas las universidades del pais que se le especifique.
- **Noticias de wordpress**: Muestra las ultimas 3 noticias de wordpress.
- **Consulta del clima**: Muestra el clima actual y el pronóstico usando la API de OpenWeather.
- **Información de países**: Permite buscar información de un país (capital, bandera, etc.).
- **Visualizador Pokémon**: Permite buscar Pokémon por nombre.
- **Conversor de divisas**: Convierte montos entre monedas usando tasas actuales.
- **Chistes aleatorios**: Muestra un chiste al azar.
- **Buscador de imágenes**: Usa la API de Unsplash para mostrar una imagen basada en una palabra clave.

```bash
git clone https://github.com/JP12JM30/tarea5.git
