{% extends 'base.php' %}

{% block title %}
    Posts | {{ parent() }}
{% endblock %}

{% block body %}

    <div class="row">
        <h1>Posts</h1>
    </div>

    {% if posts is empty %}
        <p>No posts, yet.</p>
    {% else %}
        {% for post in posts %}
            <div class="row">
                <div class="large-9 columns" role="content">
                    <article>
                        <h3><a href="{{ urlFor('logout') }}" class="logout">Logout</a></h3>
                        <h3><a href="{{ urlFor('posts.show', {'postId': post.id}) }}">{{ post.title }}</a></h3>
                        <h6>Written by {{ post.author }} on {{ post.created }}</h6>
                        <div class="row">
                            <div class="large-6 columns">
                                <p>{{ post.body[:50] }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        {% endfor %}
    {% endif %}
{% endblock %}
