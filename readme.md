# Proyek Wev Ansor Trenggalek

## Deskripsi

Proyek ini adalah aplikasi web yang menggunakan Node.js dengan struktur Model-View-Controller (MVC) dan Tailwind CSS untuk styling.

## Struktur Direktori

<details>
  <summary>Struktur Direktori</summary>

</details>

## Prasyarat

- Node.js dan npm (Node Package Manager) harus sudah terinstal di sistem Anda.

## Instalasi

1. **Clone repository:**

   ```bash
   git clone https://github.com/Nandbgus/ansor_web.git
   cd ansor_web
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```
3. **Install Tailwind CSS**
   ```bash
   npm install tailwindcss
   ```
4. **Konfigurasi Tailwind CSS**

   ```bash
   npx tailwindcss -i ./public/css/input.css -o ./public/css/output.css --watch
   ```

<details>
<summary>konfigurasi file tailwind.config.js</summary>
```javascript
module.exports = {
   mode: 'jit',
   darkMode:'class',
  content: [
    './src/**/*.{html,js}',
    './app/views/**/*.php',
    './public/index.php',
  ],
   theme: {
    extend: {
      colors: {
        primary: '#5A67D8', // Example primary color
        stroke: '#CBD5E0',  // Example stroke color
      },
      boxShadow: {
        switcher: '0 0 10px rgba(0,0,0,0.15)', // Custom shadow for the switcher
      },
    },
  },
  plugins: [],
}
```
</details>

## Menjalankan Project

1.
