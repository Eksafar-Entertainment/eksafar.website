<?php

namespace App\Helpers;

class Field
{
    var $name;
    var $label;
    var $placeholder;
    var $value;
    var $type;
    var $options = [];
    var $input_type = "text";
    var $required = false;
    var $checked = false;
    var $uid = 0;

    static $FIELD_TYPE_TEXT  = "TEXT";
    static $FIELD_TYPE_TEXTAREA  = "TEXTAREA";
    static $FIELD_TYPE_RICHTEXT  = "RICHTEXT";
    static $FIELD_TYPE_DATE      = "DATE";
    static $FIELD_TYPE_DATETIME  = "DATETIME";
    static $FIELD_TYPE_IMAGE     = "IMAGE";
    static $FIELD_TYPE_CHECKBOX  = "CHECKBOX";
    static $FIELD_TYPE_RADIO     = "RADIO";
    static $FIELD_TYPE_SELECT    = "SELECT";

    function __construct()
    {
        $this->uid = rand(11111, 99999);
    }

    function render()
    {
        $view = "form.field.text";
        switch ($this->type) {
            case Field::$FIELD_TYPE_TEXT        : $view = "form.field.text";        break;
            case Field::$FIELD_TYPE_TEXTAREA    : $view = "form.field.textarea";    break;
            case Field::$FIELD_TYPE_RICHTEXT    : $view = "form.field.richtext";    break;
            case Field::$FIELD_TYPE_DATE        : $view = "form.field.date";        break;
            case Field::$FIELD_TYPE_DATETIME    : $view = "form.field.datetime";    break;
            case Field::$FIELD_TYPE_IMAGE       : $view = "form.field.image";       break;
            case Field::$FIELD_TYPE_CHECKBOX    : $view = "form.field.checkbox";    break;
            case Field::$FIELD_TYPE_RADIO       : $view = "form.field.radio";       break;
            case Field::$FIELD_TYPE_SELECT      : $view = "form.field.select";      break;
        }
        return view($view, ["field" => $this]);
    }
}
class FormBuilder
{
    protected $fields = [];
    protected $name = "";
    protected $action = "";
    protected $method = "get";
    protected $enctype = "";
    protected $ajax = false;

    protected $default_options = [
        "name"=>"", 
        "label"=>"",  
        "value"=>"",
        "options"=>"", 
        "required" => false,
        "input_type"=>"text",
        "placeholder"=>"placeholder",
        "checked"=>false
    ];
    function __construct($name, $method = "get", $action="", $enctype = "", $ajax = false)
    {
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->ajax = $ajax;
    }
    function addText($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->input_type = $options["input_type"];
        $field->placeholder = $options["placeholder"];

        $field->type = Field::$FIELD_TYPE_TEXT;

        $this->fields[] = $field;
    }

    function addTextArea($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->placeholder = $options["placeholder"];
        $field->type = Field::$FIELD_TYPE_TEXTAREA;

        $this->fields[] = $field;
    }

    function addRichText($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->placeholder = $options["placeholder"];
        $field->type = Field::$FIELD_TYPE_RICHTEXT;

        $this->fields[] = $field;
    }

    function addDate($options=[])
    {
        $options = array_merge($options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->input_type = "date";
        $field->type = Field::$FIELD_TYPE_TEXT;

        $this->fields[] = $field;
    }
    function addDateTime($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->input_type = "datetime";
        $field->type = Field::$FIELD_TYPE_TEXT;

        $this->fields[] = $field;
    }

    function addImage($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->type = Field::$FIELD_TYPE_IMAGE;

        $this->fields[] = $field;
    }

    function addCheckBox($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->checked = $options["checked"];
        $field->type = Field::$FIELD_TYPE_CHECKBOX;

        $this->fields[] = $field;
    }

    function addRadio($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->type = Field::$FIELD_TYPE_RADIO;
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->options = $options["options"];
        
        $this->fields[] = $field;
    }

    function addSelect($options=[])
    {
        $options = array_merge($this->default_options, $options);
        $field = new Field();
        $field->name = $options["name"];
        $field->label = $options["label"];
        $field->value = $options["value"];
        $field->required = $options["required"];
        $field->options = $options;
        $field->type = Field::$FIELD_TYPE_SELECT;

        $this->fields[] = $field;
    }

    function render()
    {
        echo view("form.form", ["form" => $this]);
    }

    function getFields()
    {
        return $this->fields;
    }
}
