{% extends 'base.php' %}

{% block body %}
 <div class="row">
     <div class="small-6 columns">
         <ul>
             {% for key,  error in flash.error %}
                 <li><em>{{ error }}</em></li>
             {% endfor %}
         </ul>
         <form action="{{ urlFor('user.add') }}" method="post">
             <label for="name">Name</label>
             <input type="text" name="name" placeholder="Choose a username" id="name" autocomplete="off" />
             <label for="email">Email</label>
             <input type="text" name="email" placeholder="your@email.com" id="email" autocomplete="off" />
             <label for="password">Password</label>
             <input type="password" name="password" placeholder="Choose a password" id="password" />
             <input type="submit" class="button" value="Register">
             <input type="hidden" name="token" value="{{ token }}">
         </form>
     </div>
 </div>
{% endblock %}