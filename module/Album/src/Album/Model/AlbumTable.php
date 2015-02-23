<?php

namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

class AlbumTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();       
        
        return $resultSet;
    }

    public function getAlbum($id) {

        $id = (int) $id;

        $rowset = $this->tableGateway->select(
                array('id' => $id)
        );
        
        $row = $rowset->current(); 
        
        if(!$row) {
            throw new \Exception("Could not find row $id");            
        }
        
        return $row; 
    }
    
    public function saveAlbum(Album $album){
        
        $data = array(
            'artist' => $album->artist, 
            'title' => $album->title
        ); 
        
        $id = (int) $album->id; 
        
        if($id == 0) {
            
            $this->tableGateway->insert($data); 
            
        } else {
            $this->tableGateway->update($data, array('id' => $id)); 
        }
        
    }
    
    public function deleteAlbum(Album $album) {
        
        $this->tableGateway->delete(array('id' => (int) $album->id));
        
        
        
        
        
    }

}
