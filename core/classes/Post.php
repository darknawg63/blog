<?php

<?php # Post.php

class Post
{
    private $_db,
            $_data,
            $_sessionName;


    public function __construct($post = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
    }

    //public function update($fields = array(), $id = null)
    //{
    //    if(!$id && $this->is_LoggedIn()) {
    //        $id = $this->data()->id;
    //    }
    //    echo $id;
    //    if(!$this->_db->update('posts', $id, $fields)) {
    //        throw new Exception('There was a problem updating.');
    //    }
    //}

    public function create($fields = array())
    {
        if(Session::exists($sessionName)) {
            //$post = new Post();
            die($sessionName);
        }

        //if(!$this->_db->insert('posts', $fields)) {
        //    throw new Exception('There was a problem creating the post.');
        //}
    }

    //public function find($post = null)
    //{
    //    if($user) {
    //
    //        $field = (is_numeric($user)) ? 'id' : 'username';
    //        $data = $this->_db->get('posts', array($field, '=', $user));
    //
    //        if($data->count()) {
    //
    //            $this->_data = $data->first();
    //
    //            return true;
    //        }
    //    }
    //
    //    return false;
    //}

    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function data()
    {
        return $this->_data;
    }
}