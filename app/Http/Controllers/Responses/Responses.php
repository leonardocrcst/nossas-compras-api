<?php

namespace App\Http\Controllers\Responses;

use Illuminate\Http\Response;

class Responses extends Response
{
    private \stdClass $messageContent;

    public function __construct($content = '', $status = 200, array $extra = [], string $title = "message")
    {
        $default = [
            "Content-Type" => "application/json"
        ];
        $this->contentRegister($title, $content);
        foreach ($extra as $title => $value) {
            $this->contentRegister($title, $value);
        }
        parent::__construct(json_encode($this->messageContent), $status, $default);
    }

    private function contentRegister(string $title, $value)
    {
        if(empty($this->messageContent)) {
            $this->messageContent = new \stdClass();
        }
        $this->messageContent->$title = $value;
    }
}
