<?php

namespace database\tools;

class ColumnComment
{
    public ?string $tableCaption = null;
    public ?string $formCaption = null;
    public ?string $description = null;
    public ?string $mask = null;
    public ?string $success = null;
    public ?string $error = null;

    public function load(string $string)
    {
        $obj = json_decode($string);
        if(!json_last_error()) {
            $this->tableCaption = $obj->tc;
            $this->formCaption = $obj->fc;
            $this->description = $obj->dc;
            $this->mask = $obj->mk;
            $this->success = $obj->sc;
            $this->error = $obj->er;
        }
    }

    public function __toString(): string
    {
        $obj = new \stdClass();
        $obj->tc = $this->crop($this->tableCaption, 72);
        $obj->fc = $this->crop($this->formCaption, 120);
        $obj->dc = $this->crop($this->description, 384);
        $obj->mk = $this->crop($this->mask, 48);
        $obj->sc = $this->crop($this->success, 136);
        $obj->er = $this->crop($this->error, 136);
        return json_encode($obj);
    }

    private function crop(string $text = null, int $size = 16): ?string
    {
        return $text ?? substr($text, 0, $size);
    }
}
