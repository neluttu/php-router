<?

namespace Http\Forms;

use Core\Validator;

class RegisterForm {

    protected $errors = [];

    public function validate($email, $password, $firstname, $lastname, $phone) {

        if(!Validator::email($email))
            $this->errors['email'] = 'Please provide a valid email';
        
        if(!Validator::string($password, 7, 255))
            $this->errors['password'] = 'Password must be at least 7 characters long and at least 255 characters.';

        if(!Validator::name($firstname))
            $this->errors['firstname'] = 'Invalid firstname';

        if(!Validator::name($lastname))
            $this->errors['lastname'] = 'Invalid lastname';

        if(!Validator::phone($phone))
            $this->errors['phone'] = 'Invalid phone number...';

        return empty($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }


}