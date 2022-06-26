<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		$email = $this->input->post('username');
		$password = $this->input->post('password');
		// $email = "hasan";
		// $password = "1234";

		$e_user = array();
		$user1 = $this->db->get_where('lms_user', ['username' => $email]);
		// var_dump($user1->num_rows());
		// die;
		if ($user1->num_rows() > 0) {
			$c_user = $this->db->get_where('lms_user', ['username' => $email])->row_array();
			$e_user[] = $this->db->get_where('lms_user', ['username' => $email])->row_array();
			$d_user = $this->db->get_where('lms_user', ['username' => $email]);
		} else {
			$c_user = $this->db->get_where('lms_user', ['user_email' => $email])->row_array();
			$e_user[] = $this->db->get_where('lms_user', ['user_email' => $email])->row_array();
			$d_user = $this->db->get_where('lms_user', ['user_email' => $email]);
		}
		// die;
		if ($d_user->num_rows() > 0 && password_verify($password, $c_user['password'])) {
			echo json_encode($e_user);
		} else {
			echo json_encode("tidak");
		}
	}
	public function signup()
	{
		$state = $this->input->post('state');
		$email = $this->input->post('user_email');
		$password = $this->input->post('password');
		$username = $this->input->post('username');
		$fullname = $this->input->post('fullname');
		// $email = "mhmmdhasanz@gmail.com";
		// $password = "1234";
		// $state = "continue";
		// $username = "Jaydiej17";
		// $fullname = "Jaydiej17";
		$user = $this->db->get_where('lms_user', ['user_email' => $email]);
		$usern = $this->db->get_where('lms_user', ['username' => $username]);
		// var_dump($usern->num_rows());
		// die;
		if ($state == "first") {
			if ($user->num_rows() > 0) {
				echo json_encode("ada");
			} else if ($user->num_rows() < 1) {
				echo json_encode("tidak");
			}
		} else if ($state == "continue") {
			if ($usern->num_rows() > 0) {
				echo json_encode("ada");
			} else if ($usern->num_rows() < 1) {
				$data_user = [
					'username' => $username,
					'full_name' => $fullname,
					'user_email' => $email,
					'user_image' => 'default.jpg',
					'role_id' => 2,
					'password' => password_hash($password, PASSWORD_DEFAULT),
					'backup_pass' => $password,
					'date_created' => time()
				];
				$this->db->insert('lms_user', $data_user);
				echo json_encode("tidak");
			}
		}
	}
	public function changepassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$data['email'] = $this->input->get('email');
		$data['token'] = $this->input->get('token');

		$user_email = $this->db->get_where('lms_user_token', ['user_email' => $email, 'token' => $token]);


		$data['title'] = 'Change Password';

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|regex_match[/[!@#$%^&*()\-_=+{};:,<.>~]/]|regex_match[/[a-zA-Z]/]|regex_match[/[0-9]/]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			if ($user_email->num_rows() < 1) {
				$this->session->set_flashdata('Message', 'Sorry this session has ended.');
				redirect('not_found');
			} else {
				$this->load->view('auth/forgotpassword', $data);
			}
		} else {
			$this->_change('?email=' . $email . '&token=' . $token . '');
		}
	}
	private function _change()
	{
		$password = $this->input->post('password');
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$del_token = $this->db->get_where('lms_user_token', ['user_email' => $email, 'token' => $token])->row_array();
		$this->db->where($del_token);
		$this->db->delete('lms_user_token');

		$this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
		$this->db->set('backup_pass', $password);
		$this->db->where('user_email', $email);
		$this->db->update('lms_user');
		$this->session->set_flashdata('Message', '<div class="alert alert-success" role="alert">Your password has been reset, please enter the aplication!.</div>');
		redirect('auth/successchangepassword');
	}
	public function successchangepassword()
	{
		if ($this->session->flashdata('Message') == null) {
			$this->session->set_flashdata('Message', '<div class="alert alert-danger" role="alert">Sorry this session has ended.</div>');
			redirect('not_found');
		}
		$data['title'] = 'Success Change Password';
		$this->load->view('auth/changepassword', $data);
	}
	public function forgotpassword()
	{
		$email = $this->input->post('email');
		$same = $this->input->post('same');
		// $email = "mhmmdhasanz@gmail.com";
		// $same = "true";
		$user1 = $this->db->get_where('lms_user', ['user_email' => $email])->row_array();
		$user2 = $this->db->get_where('lms_user', ['user_email' => $email]);

		if ($same == "false") {
			$user = array();
			$user[] = $this->db->get_where('lms_user', ['user_email' => $email])->row_array();
			if ($user2->num_rows() > 0) {
				echo json_encode($user);
			} else {
				echo json_encode("tidak");
			}
		} else if ($same == "true") {
			$user3 = $this->db->get_where('lms_user_token', ['user_email' => $email]);
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'user_email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			if ($user3->num_rows() > 0) {
				$del_email = $this->db->get_where('lms_user_token', ['user_email' => $email])->row_array();
				$this->db->where($del_email);
				$this->db->delete('lms_user_token');
				$this->db->insert('lms_user_token', $user_token);
			} else if ($user3->num_rows() < 1) {
				$this->db->insert('lms_user_token', $user_token);
			}

			$config = [
				'protocol'  => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_user' => 'uapplms@gmail.com',
				'smtp_pass' => 'unglbmxjlypkfjtd',
				'smtp_crypto' => 'tls',
				'smtp_port' => 587,
				'mailtype'  => 'html',
				'chartset'  => 'utf-8',
				'newline'   => "\r\n"
			];

			$this->load->library('email', $config);

			$this->email->initialize($config);
			$this->email->from('noreply@ulmsapp.ml', 'Ulms Noreply');
			$this->email->to($email);
			$this->email->subject('Forgot Password');
			$this->email->message('
            <div bgcolor="#ffffff" style="font-family:Roboto,Helvetica,Arial,sans-serif;margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;margin:0" width="100%">
                <tbody>
                    <tr>
                        <td style="text-align:center">
							<div style="height:16px"></div>
							<h1 aria-hidden="true" style="display:inline-block;margin-top:15px;color:#ff8000"> Ulms </h1>
                            <div style="height:32px"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="padding:0 32px" width="100%">
                <table align="center" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#ffffff;border-collapse:collapse;max-width:528px;min-width:256px" width="100%">
                    <tbody>
                        <tr height="48px"></tr>
                        <tr>
                            <td style="color:#212121;font-size:20px;font-weight:700">Hai ' . $user1['full_name'] . '.</td>
                        </tr>
                        <tr height="24px"></tr>
                        <tr>
                            <td style="color:#212121;font-size:14px;font-weight:400">Saat ini anda akan mereset password anda.</td>
                        </tr>
                        <tr height="24px"></tr>
                        <tr>
                            <td>
                                <table bgcolor="#fafafa" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-bottom-left-radius:3px;border-bottom-right-radius:3px;border-top:0" width="100%">
                                    <tbody>
                                        <tr>
											<td rowspan="2" width="24px"></td>
                                            <td colspan="2" height="24px"></td>
                                            <td rowspan="2" width="24px"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                        <tr height="8px"></tr>
                                                        <tr>
                                                            <td>
                                                                <p style="margin-top:.25rem!important"> Sesi anda akan berakhir dalan 1 x 24jam. Klik tombol di bawah akan mengalihkan ke laman reset password </p>
                                                            </td>
                                                        </tr>
                                                        <tr height="20px"></tr>
                                                        <tr>
                                                            <td>
                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;display:inline-block">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><a href="' . base_url() . 'auth/changepassword?email=' . $email . '&token=' . urlencode($token) . '" style="border-radius:3px;box-sizing:border-box;display:inline-block;font-size:14px;font-weight:700;height:32px;line-height:32px;padding:0 24px;text-align:center;text-decoration:none;text-transform:uppercase;vertical-align:middle;background-color:#ff8000;color:#ffffff" target="_blank">Di sini</a></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" height="24px"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr height="48px"></tr>
                    </tbody>
                </table>
                <div style="border-top:1px solid #a0a0a0;margin:0 auto"></div>
                <div style="text-align:center;padding-top:24px;margin-bottom:2px"><p aria-hidden="true" style="display:inline-block;margin-top:15px;color:#ff8000;font-weight: bold;"> Ulms </p></div>
                <div style="color:#a0a0a0;font-size:12px;font-weight:400;text-align:center">Ulms App<br>Makassar, Sulawesi selatan<br>Indonesia</div>
            </div>
		</div>');

			// $this->email->send();
			if ($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('Message', '<div class="alert alert-danger" role="alert">Anda telah logout!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
