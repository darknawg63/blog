<?php

class Validate
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct()
    {
        // We need a db connection for the unique rule
        $this->_db = DB::getInstance();
    }

    public function email($email)
    {  
        // Remove all illegal characters from email
        // $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
        // Just checking for complience of sanity :)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                //echo "{$item} {$rule} must be {$rule_value}<br>";

                // We trim the user's input, because she might type in "Mary ".
                $value = trim($source[$item]);

                // Items are username, password, etc... Why are we escaping them??
                $item = escape($item);

                if($rule === 'required' && empty($value)) {

                    $this->addError("{$item} is required");

                } else if(!empty($value)){

                    switch($rule) {
                        case 'min':

                            if(strlen($value) < $rule_value) {

                                $this->addError("{$item} must be minimum of {$rule_value} characters");
                            }

                        break;

                        case 'max':

                            if(strlen($value) > $rule_value) {

                                $this->addError("{$item} must be maximum of {$rule_value} characters");
                            }

                        break;

                        case 'matches':

                            if($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }

                        break;

                        case 'complies':

                            if(!$this->_validate_email($value)) {
                                $this->addError("{$value} does not pass our validation test");
                            }

                        break;


                        break;

                        case 'unique':

                            $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if($check->count()) {
                                $this->addError("{$item} already exists");
                            }
                        break;
                    }
                }
            }
        }

        if(empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    protected function _validate_email($email)
    {  
        // Remove all illegal characters from email
        // $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      
        // Just checking for complience of sanity :)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {
            return false;
        }
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}

