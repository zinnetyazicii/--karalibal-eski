<?php
class ControllerCommonMaintenance extends Controller {
	public function index() {
		$this->load->language('common/maintenance');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->request->server['SERVER_PROTOCOL'] == 'HTTP/1.1') {
			$this->response->addHeader('HTTP/1.1 503 Service Unavailable');
		} else {
			$this->response->addHeader('HTTP/1.0 503 Service Unavailable');
		}

		$this->response->addHeader('Retry-After: 3600');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_maintenance'),
			'href' => $this->url->link('common/maintenance')
		);

		$data['message'] = $this->language->get('text_message');

		
		
            // Journal Theme Modification
            if (defined('JOURNAL3_ACTIVE')) {
                $this->document->setTitle($this->journal3->settings->get('maintenanceMetaTitle'));

                $data['grid'] = $this->load->controller('journal3/grid', array('module_type' => 'grid', 'module_id' => $this->journal3->settings->get('maintenanceGridModule')));
            }

            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

		    // End Journal Theme Modification
            

		$this->response->setOutput($this->load->view('common/maintenance', $data));
	}
}
