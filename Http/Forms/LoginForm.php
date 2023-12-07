<?

namespace Http\Forms;

use Core\Validator;

class LoginForm {

    protected $errors = [];

    public function validate($email, $password) {

        if(!Validator::email($email))
            $this->errors['email'] = 'Please provide a valid email';
        
        if(!Validator::string($password, 7, 255))
            $this->errors['password'] = 'Password must be at least 7 characters long and at least 255 characters.';

        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}