module.exports = {
    html: false,
    images: false,
    fonts: false,
    static: false,
    svgSprite: false,
    ghPages: false,
    stylesheets: true,

    javascripts: {
        entry: {
            app: ["./index.js"]
        }
    },

    browserSync: {
        proxy: {
            target: 'work.loc'
        }
    },

    production: {
        rev: false
    }
};