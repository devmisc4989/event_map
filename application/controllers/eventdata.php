<?php

/**
 * Controller for event management.
 */

class eventdata extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('eventmodel');
        $this->load->library('csvimport');
        $this->load->helper(array('form', 'url'));
    }

    function index(){
		//load the helper library
		$this->load->helper('form');
		$this->load->helper('url');
		//Set the message for the first time
		$data = array('msg' => "Upload File");
		$data['upload_data'] = '';

		$this->load->view('eventdata/index', $data);

    }

    function import_event(){
		//load the helper
		$this->load->helper('form');

		$file_path =  getcwd().'/application/uploads/'.'Event.csv';		

        if ($this->csvimport->get_array($file_path)) {
            $csv_array = $this->csvimport->get_array($file_path);
            foreach ($csv_array as $row) {
                $insert_data = array(
                    'title'=>$row['title'],
                    'start_date'=>$row['start_date'],
                    'end_date'=>$row['end_date'],
                    'lat'=>$row['latitude'],
                    'lon'=>$row['longitude'],
                );
                $this->csv_model->insert_events($insert_data);
            }

            $data['msg'] = "Success";
            $this->load->view('eventdata/index', $data);
            //echo "<pre>"; print_r($insert_data);
        } else {
            $data['msg'] = "Error occured: ";
            $this->load->view('eventdata/index', $data);
        }
    }
}