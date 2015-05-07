{% extends 'base.php' %}

{% block body %}
 <div class="row">
     <div class="small-6 columns">
         <ul>
             {% for key,  error in flash.error %}
                 <li><em>{{ error }}</em></li>
             {% endfor %}
         </ul>
         <form action="{{ urlFor('user.auth') }}" method="post">
             <label for="name">Name</label>
             <input type="text" name="name" placeholder="Your name" id="name" autocomplete="off" />
             <label for="password">Password</label>
             <input type="password" name="password" placeholder="Choose a password" id="password" />
             <label for="remember">Remember me</label>
             <input type="checkbox" name="remember" id="remember">
             <input type="submit" class="button" value="Register">
             <input type="hidden" name="token" value="{{ token }}">
         </form>
     </div>
 </div>
{% endblock %}