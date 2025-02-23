/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        ocean: "#3B82F6",
      },
      fontFamily: {
        body: ["Montserrat"],
        anton: ["Anton"],
        anuphan: ["Anuphan"],
      },
    },
  },
  plugins: [],
};
