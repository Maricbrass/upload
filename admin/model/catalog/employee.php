<?php
class ModelCatalogemployee extends Model {
	public function addemployee($data) {
		//echo "<pre>";print_r($data);
		// echo "<pre>";print_r("INSERT INTO " . DB_PREFIX . "employee SET name = '" . $this->db->escape($data['name']) . "', email = '". $this->db->escape($data['email'])."', password = '". $this->db->escape($data['password'])."',address = '".$this->db->escape($data['address'])."',gender = '".$this->db->escape($data['gender'])."'");
		 //exit;
		$this->db->query("INSERT INTO " . DB_PREFIX . "employee SET name = '" . $this->db->escape($data['name']) . "', email = '". $this->db->escape($data['email'])."', password = '". $this->db->escape($data['password'])."',address = '".$this->db->escape($data['address'])."',gender = '".$this->db->escape($data['gender'])."'");
		
		$employee_id = $this->db->getLastId();

		$this->cache->delete('employee');

		return $employee_id;
	}

	public function editemployee($employee_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "employee SET name = '" . $this->db->escape($data['name']) . "', email = '". $this->db->escape($data['email'])."', password = '". $this->db->escape($data['password'])."',address = '".$this->db->escape($data['address'])."',gender = '".$this->db->escape($data['gender']). "' WHERE employee_id = '" . (int)$employee_id . "'");

		
		$this->cache->delete('employee');
	}

	// public function copyemployee($employee_id) {
	// 	$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "employee e WHERE e.employee_id = '" . (int)$employee_id . "'");

	// 	if ($query->num_rows) {
	// 		$data = $query->row;

	// 		$data['sku'] = '';
	// 		$data['upc'] = '';
	// 		$data['viewed'] = '0';
	// 		$data['keyword'] = '';
	// 		$data['status'] = '0';

	// 		$data['name'] = $this->getProductAttributes($employee_id);
	// 		$data['email'] = $this->getProductDescriptions($employee_id);
	// 		$data['address'] = $this->getProductDiscounts($employee_id);
	// 		$data['gender'] = $this->getProductFilters($employee_id);
	// 		// $data['product_image'] = $this->getProductImages($employee_id);
	// 		// $data['product_option'] = $this->getProductOptions($employee_id);
	// 		// $data['product_related'] = $this->getProductRelated($employee_id);
	// 		// $data['product_reward'] = $this->getProductRewards($employee_id);
	// 		// $data['product_special'] = $this->getProductSpecials($employee_id);
	// 		// $data['product_category'] = $this->getProductCategories($employee_id);
	// 		// $data['product_download'] = $this->getProductDownloads($employee_id);
	// 		// $data['product_layout'] = $this->getProductLayouts($employee_id);
	// 		// $data['product_store'] = $this->getProductStores($employee_id);
	// 		// $data['product_recurrings'] = $this->getRecurrings($employee_id);

	// 		$this->addemployee($data);
	// 	}
	// }

	public function deleteemployee($employee_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "employee WHERE employee_id = '" . (int)$employee_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "employee_t WHERE employee_id = '" . (int)$employee_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'employee_id=" . (int)$employee_id . "'");

		$this->cache->delete('employee');
	}

	public function getemployee($employee_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'employee_id=" . (int)$employee_id . "') AS keyword FROM " . DB_PREFIX . "employee WHERE employee_id = '" . (int)$employee_id . "'");

		return $query->row;
	}

	public function getEmployeeId($employee_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "employee WHERE employee_id = '" . (int)$employee_id . "'");

		return $query->row['total'];
	}

	public function getemployees($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "employee WHERE 1=1";

		if (!empty($data['name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['name']) . "%'";
		}
		
		if (!empty($data['email'])) {
			$sql .= " AND email LIKE '" . $this->db->escape($data['email']) . "%'";
		}

		if (!empty($data['address'])) {
			$sql .= " AND address LIKE '" . $this->db->escape($data['address']) . "%'";
		}

		if (!empty($data['gender'])) {
			$sql .= " AND gender LIKE '" . $this->db->escape($data['gender']) . "%'";
		}

		$sql .= " GROUP BY employee_id";

		$sort_data = array(
			'name',
			'email',
			'address',
			'gender'
			//'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getemployeeStores($employee_id) {
		$employee_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employee_to_store WHERE employee_id = '" . (int)$employee_id . "'");

		foreach ($query->rows as $result) {
			$employee_store_data[] = $result['store_id'];
		}

		return $employee_store_data;
	}

	public function getTotalemployees() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "employee");

		return $query->row['total'];
	}
	
	public function getTotalEmployeebyname($data) {

		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "employee WHERE name LIKE '" . $this->db->escape($data['name']) . "%'");

		return $query->row['total'];
	}
}