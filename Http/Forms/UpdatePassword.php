<?
namespace Http\Forms;
use Core\Validator;

class UpdatePassword {
    protected $errors = [];
    public function validate($password, $password_verify) {

        if(empty($password) or empty($password_verify))
            $this->errors['empty'] = 'Password fields must not be empty!';

        if(!Validator::password($password))
            $this->errors['password'] = 'Password is too weak.';

        if(!Validator::match($password, $password_verify))
            $this->errors['password_verify'] = 'Passwords do not match...';

        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}