<?php
namespace Greenhex\Models;
use Greenhex\Greenhex;

class User extends Model
{
	/**
	 * Creates a new Greenhex\Models\User instance.
	 *
	 * @param	array  $data
	 */
	function __construct(array $data = [])
	{
		$this->table = 'user';
		$this->fillable =
		[
			'idname',
			'name',
			'email',
			'password',
			'token',
			'active',
			'tmp_key'
		];

		parent::__construct($data);
	}

	public function insert()
	{
		return $this->connection->insert
		(
			$this->table,
			$this->getDataForQuery()
		);
	}

	public function get($id = 0)
	{
		// check id
		if ($id == 0)
		{
			if (isset($this->data[$this->primaryKey]))
			{
				$id = $this->data[$this->primaryKey];
			}
		}

		// get data
		$data = $this->connection->get
		(
			$this->table,
			'*',
			[
				$this->primaryKey => $id
			]
		);

		// check data
		if (!empty($data) && $data != false)
		{
			$this->fill($data);
			return $this;
		}

		return null;
	}

	public function find($search)
	{
		// get data
		$data = $this->connection->get
		(
			$this->table,
			'*',
			[
				'OR' =>
				[
					$this->primaryKey => $search,
					'name' => $search,
					'email' => $search
				]
			]
		);

		// check data
		if (!empty($data) && $data != false)
		{
			$this->fill($data);
			return $this;
		}

		return null;
	}

	public function update($id = 0)
	{
		// check id
		if ($id == 0)
		{
			if (isset($this->data[$this->primaryKey]))
			{
				$id = $this->data[$this->primaryKey];
			}
		}

		// update
		$this->connection->update
		(
			$this->table,
			$this->getDataForQuery(),
			$this->getKeyForQuery()
		);
	}

	public function delete($id = 0)
	{
		// check id
		if ($id == 0)
		{
			if (isset($this->data[$this->primaryKey]))
			{
				$id = $this->data[$this->primaryKey];
			}
		}

		// delete
		return $this->connection->delete
		(
			$this->table,
			[
				$this->primaryKey => $id
			]
		);
	}
}
