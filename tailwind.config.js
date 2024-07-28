/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js", "./resources/**/*.vue",], theme: {
        extend: {
            colors: {
                base: {
                    red: '#CA3884'
                },
                background: '#F4F5FB'
            },
        },
    }, plugins: [],
}

