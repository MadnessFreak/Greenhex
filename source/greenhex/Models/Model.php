<?php
namespace Greenhex\Models;
use Greenhex\Greenhex;

abstract class Model
{
	/**
	 * The database connection.
	 *
	 * @var	Database
	 */
	protected $connection;
	/**
	 * The table associated with the model.
	 *
	 * @var	string
	 */
	protected $table;
	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';
	/**
	 * Determites if the model has been booted.
	 *
	 * @var string
	 */
	protected $booted = false;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];
	/**
	 * @var	array	Optional template data
	 */
	protected $data = [];

	/**
	 * Creates a new Greenhex\Models\DatabaseModel instance.
	 *
	 * @param	array  $data
	 */
	function __construct(array $data = [])
	{
		$this->connection = Greenhex::getApp()->db;

		if (!$this->booted && !empty($data))
		{
			$this->fill($data);
			$this->booted = true;
		}
	}

	/**
	 * Returns the value at the specified index
	 *
	 * @param	string	name
	 */
	public function __get($name)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}
		return null;
	}

	/**
	 * Sets a value to the specified index
	 *
	 * @param	string	name
	 * @param	mixed	value
	 */
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * Fills the model with an array of data.
	 *
	 * @param	array	$data
	 * @return	$this
	*/
	public function fill(array $data)
	{
		foreach ($data as $key => $value)
		{
			$this->data[$key] = $value;
		}
		return $this;
	}

	/**
	 * Get the table associated with the model.
	 *
	 * @return string
	 */
	public function getTable()
	{
		if (isset($this->table))
		{
			return $this->table;
		}

		$class = get_class($user);
		$class = explode('\\', $class);
		$class = array_pop($class);
		$class = strtolower($class);

		return $class;
	}

	/**
	 * Set the table associated with the model.
	 *
	 * @param  string  $table
	 * @return $this
	 */
	public function setTable($table)
	{
		$this->table = $table;
	}

	/**
	 * Get the primary key for the model.
	 *
	 * @return string
	 */
	public function getKeyName()
	{
		return $this->primaryKey;
	}

	/**
	 * Set the primary key for the model.
	 *
	 * @param  string  $key
	 * @return $this
	 */
	public function setKeyName($key)
	{
		$this->primaryKey = $key;
	}

	/**
	* Get the fillable attributes for the model.
	*
	* @return array
	*/
	public function getFillable()
	{
		return $this->fillable;
	}

	/**
	 * Set the fillable attributes for the model.
	 *
	 * @param  array  $fillable
	 * @return $this
	 */
	public function fillable(array $fillable)
	{
		$this->fillable = $fillable;
	}

	public function getKeyForQuery()
	{
		return [ $this->primaryKey => $this->data[$this->primaryKey] ];
	}

	public function getDataForInsert()
	{
		return array_merge($this->getKeyForQuery(), $this->getDataForQuery());
	}

	public function getDataForQuery()
	{
		$data = [];

		foreach ($this->fillable as $key)
		{
			if (isset($this->data[$key]))
			{
				$data[$key] = $this->data[$key];
			}
		}

		return $data;
	}
}
