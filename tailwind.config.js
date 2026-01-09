const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            
            colors: {
               textColor: {
                  DEFAULT: '#592303',
                  dark: '#E8DFD3',
               },              
               textSecColor: {
                  DEFAULT: '#55777d',
                  dark: '#BBAE9F',
               },

               activeColor:{
                  DEFAULT: '#84cc16',
                  dark: '#4d7c0f',
               },

               buttonColor: {
                  DEFAULT: '#592303',
                  dark: '#bf9f71',
               },
               hoverColor: {
                  DEFAULT: '#6b4c2d',
                  dark: '#999084',
               },

               bgColor: {
                  DEFAULT: '#dedeb6',
                  dark: '#2B2520',
               },
               bgSecColor: {
                  DEFAULT: '#bd9d6c',
                  dark: '#3A312A',
               },

               borderColor: {
                  DEFAULT: '#592303',
                  dark: '#BBAE9F',
               },
            },

            backgroundImage: {
               bgImage: {
                  DEFAULT: "url('/images/bg-white.webp')",
                  dark: "url('/images/bg-dark.webp')",
               }
            },
        },
    },


    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms')
    ],

};
