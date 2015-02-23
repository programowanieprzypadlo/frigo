<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;

class AlbumController extends AbstractActionController {

    /**
     * Dostęp do tabeli Album. 
     * @var \Album\Model\AlbumTable
     */
    private $albumTable;

    public function indexAction() {

        //Just passing variables to the ViewModel. 
        return new ViewModel(
                array('albums' => $this->getAlbumTable()->fetchAll())
        );
    }

    public function addAction() {

        

        $request = $this->getRequest();

        if ($request->isPost()) {

            $this->saveAlbum(); 
            
        }
        $form = new AlbumForm();
        return array('form' => $form);
    }

    public function editAction() {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->saveAlbum(); 
        }

        $album = $this->getAlbumTable()->getAlbum($this->params()->fromRoute('id'));
        
        $form = new AlbumForm();
        $form->bind($album);

        return array('form' => $form);
    }

    public function deleteAction() {
        $album = new Album();
        $album->id = $this->params()->fromRoute('id', 0);
        $this->getAlbumTable()->deleteAlbum($album);
        $this->redirect()->toRoute('album');
    }

    private function getAlbumTable() {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }

        return $this->albumTable;
    }

    private function saveAlbum() {
        $album = new Album();
        $form = new AlbumForm(); 
        
        $form->setWrapElements(true);
        
        $request = $this->getRequest(); 

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());
        if ($form->isValid()) {
            $album->exchangeArray($form->getData());
            $this->getAlbumTable()->saveAlbum($album);

            return $this->redirect()->toRoute('album');
        }
    }

}
