<?php
namespace App\Libs;

class FormFeedback {

    private $data;

    function __construct(string $data) {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->data = json_decode(str_replace('&quot;', '"', $data));
        }
    }

    public function form_feedback() {
        return isset($this->data->message) ? $this->data->message : '';
    }
    
    public function field_feedback(string $field_id) {
        return isset($this->data->fields->$field_id) ? $this->data->fields->$field_id->message : '';
    }

    public function field_val(string $field_id) {
        return isset($this->data->params) ? $this->data->params->$field_id : '';
    }

    public function is_invalid(string $field_id) {
        return isset($this->data->fields->$field_id) ? 'is-invalid' : '';
    }
}