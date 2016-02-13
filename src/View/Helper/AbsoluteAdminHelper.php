<?php
namespace AbsoluteAdmin\View\Helper;

use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\View\Helper;

class AbsoluteAdminHelper extends Helper
{

    public $helpers = [
        'Html',
        'Form'
    ];
    
    /**
     * Format nested list element
     * 
     * Callback method used by The NestableHelper
     *
     * @param array $data NestableHelper configuration
     * @param \Cake\ORM\Entity $entity Entity to format
     */
    public function nestedListFormat(array $data, Entity $entity) {
        $displayField = TableRegistry::get($entity->source())->displayField();
        
        $html = '<span class="pull-right p10 pb5">';
        
        $html .= $this->Html->link('<i class="fa fa-edit"></i> ',
            ['action' => 'edit', $entity->id],
            [
                'class' => '',
                'escape' => false,
                'title' => __d('admin', 'Edit')
            ]
        );
        
        $html .= $this->Form->postLink('<i class="fa fa-trash-o"></i>', 
            ['action' => 'delete', $entity['id']],
            [
                'class' => '', 'title' => __d('admin', 'Delete {0}', Inflector::humanize($entity->source)),
                'escape' => false,
                'confirm' =>  __d('admin', 'Are you sure you want to delete #{0} {1}?', $entity->id, $entity->{$displayField})
            ]
        );

        $html .= '</span>';
        $html .= '<div class="dd-handle" data-id="' . $entity->id . '">';
        
        if ($entity->active === false) {
            $html .= '<span class="text-muted">' . $entity->{$displayField} . '</span>';
            $html .= ' <span class="text-danger"><i class="fa fa-ban"></i><em class="sr-only">Non active</em></span>';
        } else {
            $html .= $entity->{$displayField};
        }

        $html .= '</div>';

        return $html;
    }
}