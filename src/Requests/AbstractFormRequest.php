<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:36
 */

namespace WebAppId\DDD\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class AbstractFormRequest
 */
abstract class AbstractFormRequest extends FormRequest implements FormRequestContract
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
    
    /**
     * @return mixed
     */
    abstract function rules(): array;
    
    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
    
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [];
    }
}