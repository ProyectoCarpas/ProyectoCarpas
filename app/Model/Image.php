<?php
App::uses('AppModel', 'Model');

class Image extends AppModel {

    public $name = 'Image';

    public $belongsTo = array(

        'Advertisement' => array(
            'className' => 'Advertisement',
            'foreignKey' => 'foreign_id'
            ),

        'New' => array(
            'className' => 'New',
            'foreignKey' => 'foreign_id'
            ),

        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'foreign_id'
            ),

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'foreign_id'
            ),
        );
}
?>