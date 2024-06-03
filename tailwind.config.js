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



