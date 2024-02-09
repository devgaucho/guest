var rotas={
    "about": "<div class=\"container\">\n\t<div class=\"row\">\n\t\t<div class=\"col3\"><\/div>\n\t\t<div class=\"col6\">\n\t\t\t<h2>{{title}}<\/h2>\n\t\t\t<p>\n\t\t\t\tLorem ipsum dolor, sit amet consectetur adipisicing elit. Ut impedit aliquid minus reiciendis atque voluptates, ipsa at inventore nesciunt totam a odio sunt culpa maiores. Praesentium et eius amet odio.\n\t\t\t<\/p>\n\t\t<\/div>\n\t<\/div>\n<\/div>",
    "home": "<div class=\"container\">\n\t<div class=\"row\">\n\t\t<div class=\"col3\"><\/div>\n\t\t<div class=\"col6\">\n\t\t\t<form action=\"{{SITE_URL}}\/messages\" class=\"vertical\" method=\"post\">\n\t\t\t\t<label for=\"message\">Mensagem:<\/label>\n\t\t\t\t<textarea id=\"message\" name=\"message\" maxlength=\"128\" minlength=\"1\" required><\/textarea>\n\t\t\t\t<button type=\"submit\">Enviar<\/button>\n\t\t\t<\/form>\n\t\t<\/div>\n\t<\/div>\n<\/div>",
    "msg": "<div class=\"container\">\n\t<div class=\"row\">\n\t\t<div class=\"col3\"><\/div>\n\t\t<div class=\"col6\">\n\t\t\t<h2>{{title}}<\/h2>\n\t\t\t<p>\n\t\t\t\t{{msg}}\n\t\t\t<\/p>\n\t\t\t<p>\n\t\t\t\t<a href=\"javascript:history.back();\">\n\t\t\t\t\tVoltar\n\t\t\t\t<\/a>\n\t\t\t<\/p>\n\n\t\t<\/div>\n\t<\/div>\n<\/div>"
};
var SITE_DOMAIN="http://localhost";
var SITE_NAME="Guest";
var SITE_URL="http://localhost/guest/public";
var SITE_VERSION="0.0.0";
