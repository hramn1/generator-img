<?php
date_default_timezone_set("Europe/Moscow");
$db_cfg = ['localhost', 'root', 'root', 'imgtest'];
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = null;

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }

    return $stmt;
}
class Database {
	private $db_resource;
	private $last_error = null;
	private $last_result;

	public function __construct($host, $login, $password, $db) {
		$this->db_resource = mysqli_connect($host, $login, $password, $db);
		mysqli_set_charset($this->db_resource, "utf8");

		if (!$this->db_resource) {
			$this->last_error = mysqli_connect_error();
		}
	}

	public function executeQuery($sql, $data = []) {
		$this->last_error = null;
		$stmt = db_get_prepare_stmt($this->db_resource, $sql, $data);

		if (mysqli_stmt_execute($stmt) && $r = mysqli_stmt_get_result($stmt)) {
			$this->last_result = $r;
			$res = true;
		}
		else {
			$this->last_error = mysqli_error($this->db_resource);
			$res = false;
		}

		return $res;
	}

	public function getLastError() {
		return $this->last_error;
	}

	public function getResultAsArray() {
		return mysqli_fetch_all($this->last_result, MYSQLI_ASSOC);
	}
  public function getOneResultAsArray() {
    return mysqli_fetch_assoc($this->last_result);
  }

	public function getLastId() {
		return mysqli_insert_id($this->db_resource);
	}

	public function getNumRows() {
		return mysqli_num_rows($this->last_result);
	}
}
