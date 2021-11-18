<?php
class ReporteModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getVuelos(){
        $sql = "SELECT v.origen,v.destino,v.general,v.familiar,v.suite,e.general AS cap_gen,e.familiar AS cap_fam,e.suite AS cap_sui FROM vuelo v JOIN equipo e ON v.equipo_id = e.idequipo";
        return $this->database->query($sql);
    }
    public function getCabinasVendidas(){
        $sql = "SELECT tipo_asiento FROM reserva";
        return $this->database->query($sql);
    }
}