<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class NinjaGoldGame extends CI_Controller {

	public function index()
	{
		if(! isset($this->session->userdata['total_gold']))
		{
			$activities = array();
			$this->session->set_userdata('total_gold', 0);
			$this->session->set_userdata('activity', $activities);
		}
		$this->load->view('ninja_gold_game');

	}

	public function process_money()
	{		
		//used when ninja entered a casino, display whether 'earned' or 'lost'
		$find_gold_message = 'earned';
		$gold = 0;
		$activities = array();

		switch($this->input->post('building'))
		{
			case 'farm':
				$gold = rand(10, 20);
			break;
			case 'cave':
				$gold = rand(5, 10);
			break;
			case 'house':
				$gold = rand(2, 5);
			break;
			case 'casino':
				if($this->session->userdata['total_gold'] < 50)
				{
					$activities = $this->session->userdata['activity'];
				$activities[] = 'You have to earn more money to gamble here.';
				$this->session->set_userdata('activity', $activities);
				redirect(base_url());
				}
				else
				{
					// 1 - win, 0 - lose
					$has_won = rand(0, 1);
					$find_gold_message = ($has_won == 1) ? 'earned' : 'lost';
					$gold = rand(0, 50);
				}
			break;
		}

		if($this->input->post('building') == 'casino' && $find_gold_message == 'lost')
		{
			if($has_won == 1)
			{
				$total_gold = $this->session->userdata['total_gold'] + $gold;
				$this->session->set_userdata('total_gold', $total_gold);
			}
			else
			{
				$total_gold = $this->session->userdata['total_gold'] - $gold;
				$this->session->set_userdata('total_gold', $total_gold);
			}
		}
		else
		{
			$total_gold = $this->session->userdata['total_gold'] + $gold;
			$this->session->set_userdata('total_gold', $total_gold);
		}

		$activities = $this->session->userdata['activity'];
		$activities[] = 'You entered the '. $this->input->post('building') .' and '. $find_gold_message .' '. $gold .' total golds '. date('F j, Y H:i:s a', time());
		$this->session->set_userdata('activity', $activities);

		redirect(base_url());
	}

	public function restart()
	{
		$this->session->unset_userdata('activity');
		$this->session->unset_userdata('total_gold');
		redirect(base_url());
	}
}