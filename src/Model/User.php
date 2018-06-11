<?php

namespace Model;
use \Mailjet\Resources;

class User extends \atk4\data\Model
{
    public $table = 'user';
    function init() {
        parent::init();

        $this->addFields([
            'email',
            ['name', 'required'=>true],
            'password',
            ['is_confirmed', 'type'=>'boolean'],
            ['is_admin', 'type'=>'boolean'],
        ]);

        $ref = $this->hasMany('Friend', new Friend());
        $ref->addField('total_loan', ['aggregate'=>'sum', 'type'=>'money']);
    }

    function sendEmailConfirmation()
    {
         //$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
         $mj = new \Mailjet\Client('a8ae50bb75a792c158155d78ee55cd4d', 'ee2d1b665b2253e5a4b9b25abe316df7', true,['version' => 'v3.1']);
         $body = [
           'Messages' => [
             [
               'From' => [
                 'Email' => "money-lending@frostyapps.com",
                 'Name' => "Money Lending App"
               ],
               'To' => [
                 [
                   'Email' => $this['email'],
                   'Name' => $this['name']
                 ]
               ],
               'TemplateID' => 402934,
               'TemplateLanguage' => true,
               'Subject' => "Please confirm your email",
               'Variables' => [
                   'name' => $this['name'],
                   'url'=>'http://yahoo.com'
               ]
             ]
           ]
         ];
         $response = $mj->post(Resources::$Email, ['body' => $body]);
         $response->success() && var_dump($response->getData());

    }
}
