<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Author: Victor H
	 * 
	 * Main Controller that handles communication between the view(webpages) and the model(database & queries)
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->helper('url_helper');
		$this->load->model('results_model');
	}

	public function index()
	{
		$this->load->view('wiki_game');
	}

	public function saveresult()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user', 'Username', 'trim');
		$this->form_validation->set_rules('path', 'Link Path', 'trim|required');
		$user = $this->input->post('user');
		$path = $this->input->post('path');

		//If user hasn't inputted a name, it gets saved under "Anonymous"
		if(strlen($user) === 0)
		{
			$user = "Anonymous";
		}

		if($this->form_validation->run() == FALSE)
		{
			//Reloads the page without saving the result in the DB
			redirect('Main/index');
		}
		else 
		{
			//Saves to the DB and redirects to result page. Hinders resending form on refresh/back
			$this->results_model->add_result($user, $path);
			redirect('Main/viewresults');
		}
	}

	public function viewresults()
	{
		//Dynamic data, retrieved from the DB
		$data['results'] = $this->results_model->get_results();
		$this->load->view('wiki_results', $data);
	}
}
