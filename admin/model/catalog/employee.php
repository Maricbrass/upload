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

	public function deleteemployee($employee_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "employee WHERE employee_id = '" . (int)$employee_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "employee_to_store WHERE employee_id = '" . (int)$employee_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'employee_id=" . (int)$employee_id . "'");

		$this->cache->delete('employee');
	}

	public function getemployee($employee_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'employee_id=" . (int)$employee_id . "') AS keyword FROM " . DB_PREFIX . "employee WHERE employee_id = '" . (int)$employee_id . "'");

		return $query->row;
	}

	public function getemployees($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "employee";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY emp_name";
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
}