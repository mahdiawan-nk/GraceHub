<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // One to One relationship
    public function hasOne($relatedModel, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?: $this->primaryKey;
        $relatedModelInstance = new $relatedModel;

        $this->db->select('*');
        $this->db->join($relatedModelInstance->table, $this->table . '.' . $localKey . ' = ' . $relatedModelInstance->table . '.' . $foreignKey);
        return $this->db->get($this->table)->row();
    }

    // One to Many relationship
    public function hasMany($relatedModel, $foreignKey, $localKey = null)
    {
        $localKey = $localKey ?: $this->primaryKey;
        $relatedModelInstance = new $relatedModel;

        $this->db->select('*');
        $this->db->where($foreignKey, $this->{$localKey});
        return $this->db->get($relatedModelInstance->table)->result();
    }

    // Many to Many relationship
    public function belongsToMany($relatedModel, $pivotTable, $foreignKey, $relatedKey, $localKey = null, $relatedPrimaryKey = null)
    {
        $localKey = $localKey ?: $this->primaryKey;
        $relatedModelInstance = new $relatedModel;
        $relatedPrimaryKey = $relatedPrimaryKey ?: $relatedModelInstance->primaryKey;

        $this->db->select($relatedModelInstance->table . '.*');
        $this->db->join($pivotTable, $pivotTable . '.' . $foreignKey . ' = ' . $this->table . '.' . $localKey);
        $this->db->join($relatedModelInstance->table, $pivotTable . '.' . $relatedKey . ' = ' . $relatedModelInstance->table . '.' . $relatedPrimaryKey);
        return $this->db->get($this->table)->result();
    }

    // Many to One relationship
    public function belongsTo($relatedModel, $foreignKey, $otherKey = null)
    {
        $otherKey = $otherKey ?: $this->primaryKey;
        $relatedModelInstance = new $relatedModel;

        $this->db->select($relatedModelInstance->table . '.*');
        $this->db->join($relatedModelInstance->table, $this->table . '.' . $foreignKey . ' = ' . $relatedModelInstance->table . '.' . $otherKey);
        return $this->db->get($this->table)->row();
    }
}
