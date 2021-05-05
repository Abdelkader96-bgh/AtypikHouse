<?php

namespace App\Entity\Base;


class CabaneSearch
{
    /**
     * @var int/null
     */
    private $maxPrix ;

   /**
    * @var int/null
    */
     private $maxCapacite ;

     //getters et les setters 

   /**
    * @return int/null $maxPrix 
    */
    public function getMaxPrix(): ?int
    {
        return $this->maxPrix;
    }

    /**
    * @param int/null $maxPrix 
    * @return CabaneSearch
    */
    public function setMaxPrix(int $maxPrix): CabaneSearch
    {
        $this->maxPrix = $maxPrix;

        return $this;
    }


    /**
    * @return int/null $maxCapacite 
    */
    public function getMaxCapacite(): ?int
    {
        return $this->maxCapacite;
    }

    /**
    * @param int/null $maxCapacite
    * @return CabaneSearch
    */
    public function setMaxCapacite(int $maxCapacite): CabaneSearch
    {
        $this->maxCapacite =$maxCapacite;

        return $this;
    }


}