<?php

namespace App;

class Status
{
    
    ///////////////////
    //// Statussen ////
    ///////////////////

    const NONE                  = 0; //Geen status
    const COMPLETE              = 3; //Compleet

    //Alleen voor studenten
    const NO_READER             = 6; //Geen lesmateriaal; er is geen 'complete' revisie voor de student

    //Alleen voor docenten
    const CONCEPT               = 1; //Concept
    const NEW                   = 5; //Nieuw; er is nog geen revisie
    const COMPLETE_WITH_CONCEPT = 7; //Concept, student ziet laatste complete

    public $id;
    public $title;
    public $class;

    public function __construct($id)
    {

        $this->id = $id;

        switch ($id) {
            
            case Status::CONCEPT:
                $this->title = 'Concept';
                $this->class = 'secondary';
                break;

            case Status::COMPLETE:
                $this->title = 'Compleet';
                $this->class = 'success';
                break;

            case Status::NEW:
                $this->title = 'Nieuw';
                $this->class = 'danger';
                break;

            case Status::NO_READER:
                $this->title = 'Geen lesmateriaal';
                $this->class = 'secondary';
                break;

            case Status::COMPLETE_WITH_CONCEPT:
                $this->title = 'Concept, student ziet compleet';
                $this->class = 'gradient';
                break;
            
            default:
                $this->title = 'Geen status';
                break;
        }
    }

    public function is($compare)
    {
    	return ($this->id == $compare) ? true : false;
    }

    public static function getPickables()
    {
        return collect([
            new Status(Status::CONCEPT),
            new Status(Status::COMPLETE)
        ]);
    }

}
