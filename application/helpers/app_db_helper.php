<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*Covert Date Format*/
if(!function_exists('valExist'))
{
    function valExist($table,$condition_array,$check_array)
    {
		$CI =& get_instance();
		if($check_array){
			$check = implode(",",$check_array);
		}
		$CI->db->select($check);
		$CI->db->where($condition_array);
		$get = $CI->db->get($table);
		return $get->num_rows();
    }
}

if (!function_exists('getSingleRow'))
{
    function getSingleRow($table, $where){
        $CI =& get_instance();
        $CI->db->from($table);
        $CI->db->where($where);
        $query = $CI->db->get();
        return $query->row_array();
    }
}

if (!function_exists('setSingleRow'))
{
    function setSingleRow($table, $where,$data){
        $CI =& get_instance();
		$CI->db->set($data);			
        $CI->db->where($where);
        $CI->db->update($table,$data);
        $result =  $CI->db->affected_rows();
		if($result > 0)
			return true ;
		else
			return false;
    }
}

if (!function_exists('getMultipleRows'))
{
    function getMultipleRows($table, $where){
        $CI =& get_instance();
        $CI->db->from($table);
        $CI->db->where($where);
        $query = $CI->db->get();
        return $query->result_array();
    }
}

if (!function_exists('echoArr'))
{
    function echoArr($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
    }
}





