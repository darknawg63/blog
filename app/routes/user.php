<?php

$app->get('/register', function() use ($app) {
    // Send CSRF Token
    $token = Token::generate();
    $app->render('user/new.php', [
        'token' => $token
    ]);

})->name('register');

$app->post('/user/add', function() use ($app) {

    $registration = $app->request->post();

    if(Token::check($registration['token'])) {

        $validate = new Validate();
        $validation = $validate->check($registration, array(
  
            'name'     => array(
            'required' => true,
            'unique'   => 'users'
            ),
            'email'    => array(
            'required' => true,
            'complies' => true,
            'unique'   => 'users'
            ),
            'password' => array(
            'required' => true,
            'min'      => 6
            )
        ));       

        if($validation->passed()) {

            $salt = Hash::salt(32);
            $user = new User();

            $registration['name']     = sanitize($registration['name']);
            $registration['password'] = Hash::make($registration['password'], $salt);

            $sql = "INSERT INTO users(name, email, password, salt) VALUES (:name, :email, :password, :salt)";
            $query = $app->db->prepare($sql);
            $query->execute(array(
                ':name'     => $registration['name'],
                ':email'    => $registration['email'],
                ':password' => $registration['password'],
                ':salt'     => $salt
            ));

        } else {
            $errors = $validation->errors();
            $app->flash('error', $errors);
            $app->response->redirect($app->urlFor('register'), 303);
        }
    }   
})->name('user.add');

$app->get('/login', function() use ($app) {
    // Send CSRF Token
    $token = Token::generate();
    $app->render('user/login.php', [
        'token' => $token
    ]);

})->name('login');

$app->post('/user/auth', function() use ($app) {

    $auth = $app->request->post();

    if(Token::check($auth['token'])){

    }

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
            'name'     => array('required' => true),
            'password' => array('required' => true)
    ));

    $validation->passed();
    $user = new User();
    $remember = (Input::get('remember') === 'on') ? true : false;
    $login = $user->login($auth['name'], $auth['password'], $remember);

    if($login) {

    }

})->name('user.auth');
