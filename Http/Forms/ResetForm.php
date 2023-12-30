<?
namespace Http\Forms;
use Core\Validator;

class ResetForm {
    protected $errors = [];
    public function validate($email) {

        if(!Validator::email($email))
            $this->errors['email'] = 'Please provide a valid email';
        
        return empty($this->errors);
    }
    public function errors() {
        return $this->errors;
    }

    public function appendError($field, $message) {
        $this->errors[$field] = $message;
    }
}