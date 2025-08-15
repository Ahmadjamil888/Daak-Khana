import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        name: "Bluewave",
        fontFamily: {
            sans: ["Open Sans", "ui-sans-serif", "system-ui", "sans-serif", '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji"']
        },
        extend: {
            fontFamily: {
                title: ["Lato", "ui-sans-serif", "system-ui", "sans-serif", '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji"'],
                body: ["Open Sans", "ui-sans-serif", "system-ui", "sans-serif", '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji"'],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                neutral: {
                    50: "#fafafa",
                    100: "#f5f5f5",
                    200: "#e5e5e5",
                    300: "#d4d4d4",
                    400: "#a3a3a3",
                    500: "#737373",
                    600: "#525252",
                    700: "#404040",
                    800: "#262626",
                    900: "#171717",
                    950: "#0a0a0a"
                },
                primary: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    950: "#052e16",
                    DEFAULT: "#22c55e"
                },
                pakistan: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    DEFAULT: "#22c55e"
                },
                accent: {
                    50: "#fef7ff",
                    100: "#fdeeff",
                    200: "#fcdcff",
                    300: "#f9bfff",
                    400: "#f593ff",
                    500: "#ee66ff",
                    600: "#d946ef",
                    700: "#be29ec",
                    800: "#9d21c7",
                    900: "#7e22ce",
                    950: "#581c87",
                    DEFAULT: "#d946ef"
                },
                success: {
                    50: "#f0fdf4",
                    100: "#dcfce7",
                    200: "#bbf7d0",
                    300: "#86efac",
                    400: "#4ade80",
                    500: "#22c55e",
                    600: "#16a34a",
                    700: "#15803d",
                    800: "#166534",
                    900: "#14532d",
                    950: "#052e16",
                    DEFAULT: "#22c55e"
                },
                warning: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    300: "#fcd34d",
                    400: "#fbbf24",
                    500: "#f59e0b",
                    600: "#d97706",
                    700: "#b45309",
                    800: "#92400e",
                    900: "#78350f",
                    950: "#451a03",
                    DEFAULT: "#f59e0b"
                }
            },
            fontSize: {
                xs: ["12px", { lineHeight: "19.2px" }],
                sm: ["14px", { lineHeight: "21px" }],
                base: ["16px", { lineHeight: "25.6px" }],
                lg: ["18px", { lineHeight: "27px" }],
                xl: ["20px", { lineHeight: "28px" }],
                "2xl": ["24px", { lineHeight: "31.2px" }],
                "3xl": ["30px", { lineHeight: "36px" }],
                "4xl": ["36px", { lineHeight: "41.4px" }],
                "5xl": ["48px", { lineHeight: "52.8px" }],
                "6xl": ["60px", { lineHeight: "66px" }],
                "7xl": ["72px", { lineHeight: "75.6px" }],
                "8xl": ["96px", { lineHeight: "100.8px" }],
                "9xl": ["128px", { lineHeight: "134.4px" }]
            },
            borderRadius: {
                none: "0px",
                sm: "8px",
                DEFAULT: "16px",
                md: "20px",
                lg: "28px",
                xl: "32px",
                "2xl": "40px",
                "3xl": "48px",
                full: "9999px"
            },
            spacing: {
                0: "0px",
                1: "4px",
                2: "8px",
                3: "12px",
                4: "16px",
                5: "20px",
                6: "24px",
                7: "28px",
                8: "32px",
                9: "36px",
                10: "40px",
                11: "44px",
                12: "48px",
                14: "56px",
                16: "64px",
                20: "80px",
                24: "96px",
                28: "112px",
                32: "128px",
                36: "144px",
                40: "160px",
                44: "176px",
                48: "192px",
                52: "208px",
                56: "224px",
                60: "240px",
                64: "256px",
                72: "288px",
                80: "320px",
                96: "384px",
                px: "1px",
                0.5: "2px",
                1.5: "6px",
                2.5: "10px",
                3.5: "14px"
            }
        },
    },

    plugins: [forms],
};