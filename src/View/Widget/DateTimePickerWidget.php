<?php
namespace AbsoluteAdmin\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\View\StringTemplate;

use Cake\View\Widget\WidgetInterface;
use Cake\View\Widget\BasicWidget;
use Cake\I18n\Time;


class DateTimePickerWidget extends BasicWidget
{

    /*
    
    <div class="form-group">
        <label class="control-label" for="date-start">Date Start</label>
        <input type="autocomplete" name="date_start" id="date-start" class="form-control" value="08/09/15 21:08"></div>

    <div class="form-group">
        <label class="col-md-3 control-label" for="datetimepicker2">Component Field</label>
        <div class="col-md-8">
            <div class="input-group date" id="datetimepicker2">
                <span class="input-group-addon cursor">
                    <i class="fa fa-calendar"></i>
                </span>
                <input type="text" class="form-control">
            </div>
        </div>
    </div>
    */
    public function render(array $data, ContextInterface $context)
    {

        $idPicker = $data['id'] . '_dtPicker';

        $this->_templates->add(['label' => '<label class="col-md-3 control-label"{{attrs}}>{{text}}</label>']);
        $this->_templates->add(['input' => '<div class="col-md-8"><div class="input-group date" id="' . $idPicker . '"><span class="input-group-addon cursor"><i class="fa fa-calendar"></i></span><input type="text" name="{{name}}"{{attrs}}></div></div>']);

        return parent::render($data, $context);
    }

    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}