const mix = require("laravel-mix");

mix.combine(
    ["public/css/app.css", "public/css/style-starter.css"],
    "public/css/all.css"
);

mix.combine(
    ["public/css/login/login.css", "public/css/login/styles.css"],
    "public/css/login/loginAll.css"
);
