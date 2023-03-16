<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CustomRulesRequest extends FormRequest
{
    public function rules(): Array
    {
        $method = "validateTo" . Str::ucfirst($this->route()->getActionMethod());
        return $this->$method();
    }
}