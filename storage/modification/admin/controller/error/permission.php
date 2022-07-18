<?php
class ControllerErrorPermission extends Controller {
	public function index() {
		$this->load->language('error/permission');

		$this->document->setTitle($this->language->get('heading_title'));


                if (\Journal3\Utils\Request::isAdminRequest()) {
                    $this->response->addHeader('Content-Type: application/json');

                    return $this->response->setOutput(json_encode(array(
                        'status'	=> 'error',
                        'response'	=> $this->language->get('text_permission')
                    )));
                }
            
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link($this->request->get['route'], 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('error/permission', $data));
	}
}
