<?php
class ControllerCatalogemployee extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/employee');

		$this->getList();
	}


	public function add() {
		$this->load->language('catalog/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/employee');
		//echo"<pre>";print_r($this->request->post);
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_employee->addemployee($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/employee');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_employee->editemployee($this->request->get['employee_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function copy() {
		$this->load->language('catalog/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/employee');

		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $employee_id) {
				$this->model_catalog_employee->copyemployee($employee_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['name'])) {
				$url .= '&name=' . urlencode(html_entity_decode($this->request->get['name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['email'])) {
				$url .= '&email=' . urlencode(html_entity_decode($this->request->get['email'], ENT_QUOTES, 'UTF-8'));
			}

			// if (isset($this->request->get['filter_price'])) {
			// 	$url .= '&filter_price=' . $this->request->get['filter_price'];
			// }

			// if (isset($this->request->get['filter_quantity'])) {
			// 	$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			// }

			// if (isset($this->request->get['filter_status'])) {
			// 	$url .= '&filter_status=' . $this->request->get['filter_status'];
			// }

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function delete() {
		$this->load->language('catalog/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/employee');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $employee_id) {
				$this->model_catalog_employee->deleteemployee($employee_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['name'])) {
			$name = $this->request->get['name'];
		} else {
			$name = null;
		}
		if (isset($this->request->get['email'])) {
			$email = $this->request->get['email'];
		} else {
			$email = null;
		}
		if (isset($this->request->get['address'])) {
			$address = $this->request->get['address'];
		} else {
			$address = null;
		}
		if (isset($this->request->get['gender'])) {
			$gender = $this->request->get['gender'];
		} else {
			$gender = null;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		if (isset($this->request->get['employee_id'])) {
			$employee_id = $this->request->get['employee_id'];
		} else {
			$employee_id = null;
		}
		// if (isset($this->request->get['emp_name'])) {
		// 	$emp_name = $this->request->get['emp_name'];
		// } else {
		// 	$emp_name = null;
		// }
		// if (isset($this->request->get['emp_email'])) {
		// 	$emp_email = $this->request->get['emp_email'];
		// } else {
		// 	$emp_email = null;
		// }
		// if (isset($this->request->get['emp_password'])) {
		// 	$emp_password = $this->request->get['emp_password'];
		// } else {
		// 	$emp_password = null;
		// }

		// if (isset($this->request->get['emp_address'])) {
		// 	$emp_address = $this->request->get['emp_address'];
		// } else {
		// 	$emp_address = null;
		// }

		// if (isset($this->request->get['emp_gender'])) {
		// 	$emp_gender = $this->request->get['emp_gender'];
		// } else {
		// 	$emp_gender = null;
		// }
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/employee/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/employee/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['employees'] = array();

		$filter_data = array(
			//'employee_id' => $employee_id,
			'name'	      => $name,
			'email'	      => $email,
			'address'	  => $address,
			'gender'	  => $gender,
			'sort'     => $sort,
			'order'    => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$employee_total = $this->model_catalog_employee->getTotalemployees($filter_data);
		$employee_total_name = $this->model_catalog_employee->getTotalEmployeebyname($filter_data);

		$results = $this->model_catalog_employee->getemployees($filter_data);

		foreach ($results as $result) {
			$data['employees'][] = array(
				'employee_id'     => $result['employee_id'],
				'name'            => $result['name'],
				'email'           => $result['email'],
				'address'         => $result['address'],
				'gender'          => $result['gender'],
				'edit'            => $this->url->link('catalog/employee/edit', 'token=' . $this->session->data['token'] . '&employee_id=' . $result['employee_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_email'] = $this->language->get('column_email');
		$data['column_address'] = $this->language->get('column_address');
		$data['column_gender'] = $this->language->get('column_gender');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_clear'] = $this->language->get('button_clear');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['name'])) {
			$url .= '&name=' . urlencode(html_entity_decode($this->request->get['name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['email'])) {
			$url .= '&email=' . urlencode(html_entity_decode($this->request->get['email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['address'])) {
			$url .= '&address=' . urlencode(html_entity_decode($this->request->get['address'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['gender'])) {
			$url .= '&gender=' . urlencode(html_entity_decode($this->request->get['gender'], ENT_QUOTES, 'UTF-8'));
		}


		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_email'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
		$data['sort_address'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . '&sort=address' . $url, true);
		$data['sort_gender'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . '&sort=gender' . $url, true);
		//$data['sort_sort_order'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';



		if (isset($this->request->get['name'])) {
			$url .= '&name=' . urlencode(html_entity_decode($this->request->get['name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['email'])) {
			$url .= '&email=' . urlencode(html_entity_decode($this->request->get['email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['address'])) {
			$url .= '&address=' . urlencode(html_entity_decode($this->request->get['address'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['gender'])) {
			$url .= '&gender=' . urlencode(html_entity_decode($this->request->get['gender'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
//	if (isset($this->request->get['name']) && isset($this->request->get['email'])){
		$pagination = new Pagination();
		$pagination->total = $employee_total_name;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/employee', 'token=' . $this->session->data['token']  . '&page={page}' . $url, true);

		$data['pagination'] = $pagination->render();
//	 }
	//  else{
	// 	$pagination = new Pagination();
	// 	$pagination->total = $employee_total;
	// 	$pagination->page = $page;
	// 	$pagination->limit = $this->config->get('config_limit_admin');
	// 	$pagination->url = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

	// 	$data['pagination'] = $pagination->render();
	// }
		$data['results'] = sprintf($this->language->get('text_pagination'), ($employee_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($employee_total - $this->config->get('config_limit_admin'))) ? $employee_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $employee_total, ceil($employee_total / $this->config->get('config_limit_admin')));

		$data['name'] = $name;
		$data['email'] = $email;
		$data['address']= $address;
		$data['gender']= $gender;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/employee_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['employee_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['emp_name'] = $this->language->get('emp_name');
		$data['emp_email'] = $this->language->get('emp_email');
		$data['emp_password'] = $this->language->get('emp_password');
		$data['emp_address'] = $this->language->get('emp_address');
		$data['emp_gender'] = $this->language->get('emp_gender');
		// $data['entry_customer_group'] = $this->language->get('entry_customer_group');

		$data['help_keyword'] = $this->language->get('help_keyword');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['employee_id'])) {
			$data['action'] = $this->url->link('catalog/employee/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/employee/edit', 'token=' . $this->session->data['token'] . '&employee_id=' . $this->request->get['employee_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/employee', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['employee_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$employee_info = $this->model_catalog_employee->getemployee($this->request->get['employee_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($employee_info)) {
			$data['name'] = $employee_info['name'];
		} else {
			$data['name'] = '';
		}

		//$this->load->model('setting/store');

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($employee_info)) {
			$data['email'] = $employee_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} elseif (!empty($employee_info)) {
			$data['password'] = $employee_info['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (!empty($employee_info)) {
			$data['address'] = $employee_info['address'];
		} else {
			$data['address'] = '';
		}
		
		if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		} elseif (!empty($employee_info)) {
			$data['gender'] = $employee_info['gender'];
		} else {
			$data['gender'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/employee_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/employee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		// if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
		// 	$this->error['name'] = $this->language->get('error_name');
		// }

		// if (utf8_strlen($this->request->post['keyword']) > 0) {
		// 	$this->load->model('catalog/url_alias');

		// 	$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

		// 	if ($url_alias_info && isset($this->request->get['employee_id']) && $url_alias_info['query'] != 'employee_id=' . $this->request->get['employee_id']) {
		// 		$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
		// 	}

		// 	if ($url_alias_info && !isset($this->request->get['employee_id'])) {
		// 		$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
		// 	}
		// }

		return !$this->error;
	}
	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/employee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/employee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/employee');

		// foreach ($this->request->post['selected'] as $employee_id) {
		// 	$employee_total = $this->model_catalog_employee->getEmployeeId($employee_id);

		// 	if ($employee_total) {
		// 		$this->error['warning'] = sprintf($this->language->get('error_product'), $employee_total);
		// 	}
		// }

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['name']) || isset($this->request->get['email']) || isset($this->request->get['address'])) {
			$this->load->model('catalog/employee');

			if (isset($this->request->get['name'])) {
				$name = $this->request->get['name'];
			} else {
				$name = '';
			}
			if (isset($this->request->get['email'])) {
				$email = $this->request->get['email'];
			} else {
				$email = '';
			}
			if (isset($this->request->get['address'])) {
				$address = $this->request->get['address'];
			} else {
				$address = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				
				'name'  => $name,
				'email'  => $email,
				'address' => $address,
				'start'       => 0,
				'limit'       => $limit
			);

			$results = $this->model_catalog_employee->getemployees($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'name'             => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'email'            => strip_tags(html_entity_decode($result['email'], ENT_QUOTES, 'UTF-8')),
					'address'          => strip_tags(html_entity_decode($result['address'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		// $sort_order = array();

		// foreach ($json as $key => $value) {
		// 	$sort_order[$key] = $value['name'];
		// 	$sort_order[$key] = $value['email'];
		// }

		// array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
 }