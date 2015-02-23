<?php

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->add(
                array(
                    'name' => 'id',
                    'type' => 'hidden'
                )
        );

        $this->add(
                array(
                    'name' => 'title',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Tytuł'
                    )
                )
        );

        $this->add(
                array(
                    'name' => 'artist',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Artysta'
                    )
                )
        );

        $this->add(
                array(
                    'name' => 'submit',
                    'type' => 'Submit', 
                    'attributes' => array(
                        'value' => 'Go', 
                        'id' => 'submitbutton'
                    )
                )
        );
    }

}
