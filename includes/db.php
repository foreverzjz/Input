<?php
/*
为了数据库连接的通用性创建一个数据库的类
*/
class db
{
	private $host;
	private $user;
	private $pass;
	private $s_db;
	function __construct($host,$user,$pass,$s_db)
	{
		//数据库初始化函数
		$this->host=$host;
		$this->user=$user;
		$this->pass=$pass;
		$this->s_db=$s_db;
		$this->connect();
	}
	function connect()
	{
		//数据库连接函数

		$link=@mysql_connect($this->host,$this->user,$this->pass) or die("connect_error");
		mysql_select_db($this->s_db) or die("不存在".$this->s_db."数据库");
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET CHARACTER SET UTF8");
	    mysql_query("SET CHARACTER_SET_RESULTS=UTF8");
	}
	function query($sql, $type = '')
	{
		//数据库语句查询
		if(!($query = mysql_query($sql))) $this->show('Say:', $sql);
		return $query;
	}

	function show($message = '', $sql = '')
	{
		//判断查询语句是否正确
		if(!$sql) echo $message;
		else echo $message.'<br>'.$sql;
	}
	function affected_rows()
	{
		//影响的行数
		return mysql_affected_rows();
	}

	function result($query, $row)
	{
		//返回查询结果
		return mysql_result($query, $row);
	}

	function num_rows($query)
	{
		return @mysql_num_rows($query);
	}

	function num_fields($query)
	{
		return mysql_num_fields($query);
	}

	function free_result($query)
	{
		return mysql_free_result($query);
	}

	function insert_id()
	{
		return mysql_insert_id();
	}

	function fetch_row($query)
	{
		return mysql_fetch_row($query);
	}
	function  fetch_array($query)
	{
		return mysql_fetch_array($query);
	}

	function version() {
		return mysql_get_server_info();
	}

	function close() {
		return mysql_close();
	}


	//==============

	function fn_insert($table,$name,$value){

		$this->query("insert into $table ($name) value ($value)");

	}


}
	//新建一个数据库的实体类；
	//$mydb = new db("localhost","root","","myblog");

?>