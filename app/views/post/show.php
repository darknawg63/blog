{% extends 'base.php' %}

{% block body %}
<div class="row">
    <div class="large-9 columns" role="content">
        <h3><a href="{{ urlFor('post.index') }}">Home</a></h3>
        <article>
            <h3>{{ post.title }}</h3>
            <h6>Written by {{ post.author }} on {{ post.created }}</h6>
            <div class="row">
                <div class="large-6 columns">
                    <p>{{ post.body }}</p>
                </div>
                <div class="large-6 columns">
                    <img src="http://placehold.it/400x240&text=[img]"/>
                </div>
            </div>
        </article>
    </div>
</div>
{% endblock %}