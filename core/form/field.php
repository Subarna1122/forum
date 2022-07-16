<?php
namespace app\core\form;
use app\core\Model;
class Field
{
    public Model $model;
    public $attribute;

    public function __construct(Model $model, $attribute)
    {
        $this->$model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf('
        <div class="form-group">
        <label >%s</label><br>
         <input type="text" name="%s" value="%s" class="form-control">
         <div class="invalid feedback">
            %s
         /<div>
       </div>
        ',
        $this->attribute,
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? ' is-invalid ' : "",
        $this->model->getFirstError($this->attribute)
    );
    }
}