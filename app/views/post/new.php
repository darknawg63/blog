{% extends 'base.php' %}

{% block body %}
 <div class="row">
     <div class="small-9 columns">
         <ul>
             {% for key,  error in flash.error %}
                 <li><em>{{ error }}</em></li>
             {% endfor %}
         </ul>
         <form action="{{ urlFor('post.add') }}" method="post">
             <label for="title">Title</label>
             <input type="text" name="title" placeholder="Title" id="title" autocomplete="off" />
             <label for="body">Body</label>
             <textarea name="body" id="body"></textarea>
             <input type="submit" class="button" value="Save">
             <input type="hidden" name="token" value="{{ token }}">
         </form>
     </div>
 </div>
{% endblock %}