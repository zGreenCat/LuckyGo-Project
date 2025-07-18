# LuckyGo Project

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)

## 📋 Descripción

LuckyGo es un proyecto web desarrollado con Laravel que utiliza tecnologías modernas como Vite para el bundling de assets y Tailwind CSS para el diseño.

## 🚀 Tecnologías

- **Backend**: Laravel (PHP)
- **Frontend**: Blade Templates
- **CSS Framework**: Tailwind CSS
- **Build Tool**: Vite
- **Database**: MySQL/PostgreSQL
- **Testing**: PHPUnit

## 📦 Requisitos

- PHP >= 8.1
- Composer
- Node.js >= 16
- npm o yarn
- MySQL/PostgreSQL

## 🔧 Instalación

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/zGreenCat/LuckyGo-Project.git
   cd LuckyGo-Project
   ```

2. **Instala las dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instala las dependencias de Node.js**
   ```bash
   npm install
   ```

4. **Configura el entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configura la base de datos**
   - Edita el archivo `.env` con tus credenciales de base de datos
   - Ejecuta las migraciones:
     ```bash
     php artisan migrate
     ```

6. **Compila los assets**
   ```bash
   npm run build
   ```

## 🏃‍♂️ Uso

### Desarrollo

1. **Inicia el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

2. **Inicia el servidor de Vite (en otra terminal)**
   ```bash
   npm run dev
   ```

3. **Visita la aplicación**
   - Abre tu navegador en `http://localhost:8000`

### Producción

1. **Optimiza la aplicación**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Compila los assets para producción**
   ```bash
   npm run build
   ```

## 🧪 Testing

Ejecuta las pruebas con PHPUnit:

```bash
# Ejecutar todas las pruebas
php artisan test

# Ejecutar pruebas específicas
php artisan test --filter=NombreDeLaPrueba
```

## 📁 Estructura del Proyecto

```
LuckyGo-Project/
├── app/                 # Lógica de la aplicación
├── bootstrap/           # Archivos de arranque
├── config/             # Archivos de configuración
├── database/           # Migraciones y seeders
├── public/             # Archivos públicos
├── resources/          # Vistas, CSS, JS
├── routes/             # Definición de rutas
├── storage/            # Archivos de almacenamiento
├── tests/              # Pruebas automatizadas
├── composer.json       # Dependencias PHP
├── package.json        # Dependencias Node.js
├── tailwind.config.js  # Configuración Tailwind
└── vite.config.js      # Configuración Vite
```

## 🎨 Personalización

### Tailwind CSS

El proyecto utiliza Tailwind CSS para el diseño. Puedes personalizar los estilos editando:

- `tailwind.config.js` - Configuración de Tailwind
- `resources/css/app.css` - Estilos personalizados

### Vite

La configuración de Vite se encuentra en `vite.config.js`. Aquí puedes:

- Agregar nuevos puntos de entrada
- Configurar plugins adicionales
- Personalizar el proceso de build

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👤 Autor

**zGreenCat**
- GitHub: [@zGreenCat](https://github.com/zGreenCat)

## 🙏 Agradecimientos

- Laravel Framework
- Tailwind CSS
- Vite
- Toda la comunidad open source

---

⭐ ¡Dale una estrella si este proyecto te fue útil!