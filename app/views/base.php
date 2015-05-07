<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        {% block head %}
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>{% block title %}{% endblock %} Slim blog</title>
            <link rel="stylesheet" href="/blog/public/css/foundation.css" />
            <link rel="stylesheet" href="/blog/public/css/app.css" />
            <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
            <script src="/blog/public/js/vendor/modernizr.js"></script>
        {% endblock %}
    </head>
    <body>
        <header class="header">
            Slim blog
        </header>
        {% block body %}
            
        {% endblock %}
        <footer class="footer">
            Copyright © blogspots.org
        </footer>
        <script src="/blog/public/js/vendor/jquery.js"></script>
        <script src="/blog/public/js/foundation/foundation.js"></script>
        <script src="/blog/public/js/jquery.sauron.js"></script>
        <script src="/blog/public/js/app.js"></script>
        <script src="/blog/public/js/util.js"></script>
    </body>
</html>