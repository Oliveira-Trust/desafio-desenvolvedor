export default {
    content: [
        './resources/**/*.{js,vue,blade.php}',
        './node_modules/tw-elements/js/**/*.js',
    ],
    theme: {},
    darkMode: 'class',
    plugins: [require('tw-elements/plugin.cjs')],
}
