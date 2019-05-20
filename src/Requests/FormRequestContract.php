<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 22:37
 */

namespace WebAppId\DDD\Requests;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface FormRequestContract
 */
interface FormRequestContract
{
    public function authorize(): bool;
    
    public function rules(): array;
    
    public function messages(): array;
    
    public function attributes(): array;
}