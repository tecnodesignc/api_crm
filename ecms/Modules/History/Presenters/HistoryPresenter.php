<?php


namespace Modules\History\Presenters;
use Laracasts\Presenter\Presenter;

class HistoryPresenter extends Presenter
{

     /**
      * @var VehicleRepository
      */
     private $vehicle;

     public function __construct($entity)
     {
         parent::__construct($entity);
         $this->vehicle= app('Modules\History\Repositories\HistoryRepository');
     }

     /**
      * Get The Type Vehicle
      *@returns string
      */

     public function messageValue():string
     {
         switch ($this->entity->type) {
             case 1:
                 switch ($this->entity->message){
                     case 0:
                         return 'No Disponible';
                         break;
                     case 1:
                         return 'Libre';
                         break;
                     case 2:
                         return 'Ocupado';
                         break;
                     default:
                         return 'No Valido';
                         break;
                 }
                 break;
             default:
                 return $this->entity->message;
                 break;
         }
     }

}
