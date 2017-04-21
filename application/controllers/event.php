<?php

/**
 * Controller for event management.
 */

class event extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('eventmodel');
    }

    function index(){
    	$data['city_list'] = $this->eventmodel->getCities();
        $this->load->view('event/index', $data);
    }

    function search(){
        $city_name = $this->input->post('city_name');
        $event_filter = $this->input->post('event_filter');
        $event_order = ($this->input->post('event_order')) ? $this->input->post('event_order') : 'asc';

        $selected_city = $this->eventmodel->getCity($city_name);
        $data['city_name'] = $city_name;
        $data['event_filter'] = $event_filter;
        $data['event_order'] = ($event_order == 'asc') ? 'desc' : 'asc';

        $data['city_list'] = $this->eventmodel->getCities();
        $data['event_list'] = array();
        if(count($selected_city) > 0){
            $lat = $selected_city[0]['lat'];
            $lon = $selected_city[0]['lon'];

            $data['location']['lat'] = $lat;
            $data['location']['lon'] = $lon;

            $event_list = $this->eventmodel->getEventsFromPos($lat, $lon, $event_filter, $event_order);

            $data['event_list'] = $event_list;

            $data['event_list_xml'] = "<markers>";

            foreach ($event_list as $item){
                $data['event_list_xml'] = $data['event_list_xml'] . '<marker title ="Event" lat="'. $item['lat'] . '" lon="' . $item['lon'] . '"/>';                
            }            
            $data['event_list_xml'] = $data['event_list_xml'] . "</markers>";

            $data['event_list_xml'] = $this->escapeJavaScriptText($data['event_list_xml']);
        }
    	$this->load->view('event/index', $data);
    }

    function escapeJavaScriptText($string){
        return str_replace("'", "", $string);
    }
}