<?php


class eventmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getCities(){
        $this->db->from('cities');        

        $result = $this->db->get()->result_array();
        return $result;        
    }

    public function getCity($search){
        $this->db->from('cities');
        $this->db->where('search', $search);
        $this->db->limit(1, 0);        

        $result = $this->db->get()->result_array();
        return $result;        
    }

    public function getEventsFromPos($lat, $lon, $event_filter, $event_order){
        // $p = '0.017453292519943295';
        // $a = ;
        // $d = 12742 * asin(sqrt(0.5 - cos((lat2 - $lat) * 0.017453292519943295)/2 + cos($lat * 0.017453292519943295) * cos(lat2 * 0.017453292519943295) * (1 - cos((lon2 - $lon) * 0.017453292519943295))/2));
        $sql = "select * from events 
                where 12742 * asin(sqrt(0.5 - cos((lat - $lat) * 0.017453292519943295)/2 + cos($lat * 0.017453292519943295) * cos(lat * 0.017453292519943295) * (1 - cos((lon - $lon) * 0.017453292519943295))/2)) < 25
                and title like '%$event_filter%'
                order by start_date $event_order";

        $result = $this->db->query($sql)->result_array();
        return $result;                
    }
}