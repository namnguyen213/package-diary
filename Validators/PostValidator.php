<?php namespace Foostart\Diary\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Diary\Models\Diary;

use Illuminate\Support\MessageBag as MessageBag;

class DiaryValidator extends FooValidator
{

    protected $obj_diary;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'diary_name' => ["required"],
            'user_id' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_diary = new Diary();

        // language
        $this->lang_front = 'diary-front';
        $this->lang_admin = 'diary-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'diary_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'user_id.required'      => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.overview')]),
            ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'name' => [
                'key' => 'diary_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['diary_name']['min'],
                'max' => $_ln['diary_name']['max'],
            ],
            'user_id' => [
                'key' => 'user_id',
                'label' => trans($this->lang_admin.'.fields.user_id'),
                'min' => $_ln['user_id']['min'],
                'max' => $_ln['user_id']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['diary_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['user_id'], $params['user_id']) ? $flag : FALSE;

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-diary');
        return $configs;
    }

}