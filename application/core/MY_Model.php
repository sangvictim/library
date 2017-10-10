<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

	protected $table      = null;
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];
	protected $timestamp  = true;

	protected $skip = array(
		'beforeGet'    => false,
		'afterGet'     => false,
		'beforeInsert' => false,
		'afterInsert'  => false,
		'beforeUpdate' => false,
		'afterUpdate'  => false,
		'beforeDelete' => false,
		'afterDelete'  => false,
	);

	public function __construct()
	{
		parent::__construct();
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	public function _isAssoc($array)
	{
		return (array_values($array) !== $array);
	}

	public function _from()
	{
		if ($this->table) {
			$this->db->from($this->table . ' this');
		} else {
			throw new Exception("Table not defined", 1);
		}
	}

	/**
	 * Deprecated
	 * @param  array $data
	 * @return array
	 */
	public function _fillable($data)
	{
		return $this->_filterField($data);
	}

	public function _filterField($data)
	{
		if (count($this->fillable) > 0) {
			// Whitelist Filter
			$out = [];
			foreach ($this->fillable as $key) {
				if (array_key_exists($key, $data)) {
					$out[$key] = $data[$key];
				}
			}
			if (array_key_exists('created_at', $data)) {
				$out['created_at'] = $data['created_at'];
			}

			if (array_key_exists('updated_at', $data)) {
				$out['updated_at'] = $data['updated_at'];
			}

			return $out;
		} elseif (count($this->guarded) > 0) {
			// Blacklist Filter
			$out = $data;
			foreach ($this->guarded as $key) {
				if (array_key_exists($key, $out)) {
					unset($out[$key]);
				}
				return $out;
			}
		} else {
			return $data;
		}
	}

	public function find($id)
	{
		$aidi = $this->encrypt->decode(urldecode(str_replace("-", "%", $id)));
		return $this->where('this.' . $this->primaryKey, $aidi)->row();
	}

	public function get()
	{
		if ( ! $this->skip['beforeGet']) {
			$this->beforeGet();
		} else {
			$this->skip['beforeGet'] = false;
		}

		$this->_from();
		$result = $this->db->get();

		if ( ! $this->skip['afterGet']) {
			$this->afterGet($result);
		} else {
			$this->skip['afterGet'] = false;
		}

		return $result;
	}

	public function _insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this;
	}

	public function insert($data)
	{
		if ( ! $this->skip['beforeInsert']) {
			$this->beforeInsert($data);
		} else {
			$this->skip['beforeInsert'] = false;
		}

		// Refresh created_at & updated_at column values
		if ($this->timestamp) {
			if (!array_key_exists('created_at', $data)) {
				$data['created_at'] = date('Y-m-d h:i:s');
			}

			if (!array_key_exists('updated_at', $data)) {
				$data['updated_at'] = date('Y-m-d h:i:s');
			}

		}
		$this->_insert($this->_filterField($data));
		$id   = $this->db->insert_id();
		$data = $this->find($id);

		if ( ! $this->skip['afterInsert']) {
			$this->afterInsert($data, $id);
		} else {
			$this->skip['afterInsert'] = false;
		}
		return $data;
	}

	public function _update($data)
	{
		$this->db->update($this->table, $data);
		return $this;
	}

	public function update($data, $id)
	{
		$aidi = $this->encrypt->decode(urldecode(str_replace("-", "%", $id)));
		if ( ! $this->skip['beforeUpdate']) {
			$this->beforeUpdate($data, $aidi);
		} else {
			$this->skip['beforeUpdate'] = false;
		}

		// Refresh updated_at column values
		if ($this->timestamp) {
			if (!array_key_exists('updated_at', $data)) {
				$data['updated_at'] = date('Y-m-d h:i:s');
			}

		}

		$old_data = $this->find($id);
		$this->where($this->primaryKey, $aidi);
		$this->_update($this->_filterField($data));
		$data = $this->find($id);

		if ( ! $this->skip['afterUpdate']) {
			$this->afterUpdate($data, $aidi, $old_data);
		} else {
			$this->skip['afterUpdate'] = false;
		}
		return $data;
	}

	public function patch($data)
	{
		$row = $this->row();
		return $row ? $this->update($data, $row->{$this->primaryKey}) : false;
	}

	public function patchAll($data)
	{
		$all = $this->all();
		$out = [];
		foreach ($all as $row) {
			$out[] = $this->update($data, $row->{$this->primaryKey});
		}
		return $out;
	}

	public function instance()
	{
		return clone ($this);
	}

	public function all()
	{
		return $this->get()->result();
	}

	public function row()
	{
		return $this->limit(1)->get()->row();
	}

	public function where($key, $value = null)
	{
		$this->db->where($key, $value);
		return $this;
	}

	public function filter($filter)
	{
		if ($filter) {
			foreach ($filter as $key => $value) {
				if ($value) {
					$key = ($key[0] == '_') ? 'this.' . ltrim($key, '_') : $key;
					$this->where($key, $value);
				}
			}
			return $this;
		}
	}

	public function _join($table, $cond, $type = '')
	{
		$this->db->join($table, $cond, $type);
		return $this;
	}

	public function join($table, $localKey, $targetKey = 'id', $tipe = 'LEFT')
	{
		$alias = explode(' ', $table);
		$alias = count($alias) == 2 ? $alias[1] : $table;
		$on    = sprintf('this.%s = %s.%s', $localKey, $alias, $targetKey);
		$this->_join($table, $on, $tipe);
		return $this;
	}

	public function hasMany($table, $targetKey, $localKey = null)
	{
		$localKey = $localKey ?: $this->primaryKey;
		return $this->join($table, $localKey, $targetKey);
	}

	public function belongTo($table, $localKey, $targetKey = null)
	{
		return $this->join($table, $localKey, $targetKey);
	}

	public function select($field)
	{
		$this->db->select($field);
		return $this;
	}

	public function _delete()
	{
		$this->db->delete($this->table);
		return $this;
	}

	public function delete($id)
	{
		$aidi = $this->encrypt->decode(urldecode(str_replace("-", "%", $id)));
		$data = $this->find($id);
		if ( ! $this->skip['beforeDelete']) {
			$this->beforeDelete($data, $aidi);
		} else {
			$this->skip['beforeDelete'] = false;
		}

		$this->db->where($this->primaryKey, $aidi);
		$this->_delete();

		if ( ! $this->skip['afterDelete']) {
			$this->afterDelete($data, $aidi);
		} else {
			$this->skip['afterDelete'] = false;
		}
		return $data;
	}

	public function destroy()
	{
		$row = $this->row();
		return $row ? $this->delete($row->{$this->primaryKey}) : false;
	}

	public function destroyAll()
	{
		$all = $this->all();
		$out = [];
		foreach ($all as $row) {
			$out[] = $this->delete($row->{$this->primaryKey});
		}
		return $out;
	}

	public function groupBy($field)
	{
		$this->db->group_by($field);
		return $this;
	}

	public function orderByAsc($field, $type = 'ASC')
	{
		$this->db->order_by($field, $type);
		return $this;
	}
	public function orderByDesc($field, $type = 'DESC')
	{
		$this->db->order_by($field, $type);
		return $this;
	}

	public function limit($limit, $offset = null)
	{
		$this->db->limit($limit, $offset);
		return $this;
	}

	public function skip($function)
	{
		$this->skip[$function] = TRUE;
		return $this;
	}

	public function skipAll()
	{
		foreach ($this->skip as $key => $value) {
			$this->skip($key);
		}
		return $this;
	}

	protected function beforeGet()
	{
		# code...
	}

	protected function afterGet(&$data)
	{
		# code...
	}

	protected function beforeInsert(&$data)
	{
		# code...
	}

	protected function afterInsert($data, $id)
	{
		# code...
	}

	protected function beforeUpdate(&$data, $id)
	{
		# code...
	}

	public function afterUpdate($data, $id)
	{
		# code...
	}

	public function beforeDelete($data, $id)
	{
		# code...
	}

	public function afterDelete($data, $id)
	{
		# code...
	}
}

/* End of file mY_Model.php */
/* Location: ./application/models/mY_Model.php */
