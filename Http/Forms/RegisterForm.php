<?

namespace Http\Forms;

use Core\Validator;

class RegisterForm {

    protected $errors = [];

    public function validate($email, $password, $firstname, $lastname, $phone) {

        if(!Validator::email($email))
            $this->errors['email'] = 'Please provide a valid email';
        
        if(!Validator::password($password))
            $this->errors['password'] = 'Password must contain: minimum 8 characters, one UPPERCASE and one speci@l symbol.';

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