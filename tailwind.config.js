/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            "trust-p1": "#e7e7e9",
            "trust-p2": "#767c88",
            "trust-p3": "#2a3849",
            "trust-p4": "#78b3cf",
            "trust-p5": "#050d16",
            "trust-p6": "#668db4",
            "trust-p7": "#c60a0a",
            "trust-p8": "#776665",
            "trust-p9": "#061325",
            "trust-p10": "#061325",
        },
    },
  },
  plugins: [],
}

