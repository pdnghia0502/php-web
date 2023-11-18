<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/database.php");
include_once ($filepath."/../helpers/format.php");	
?>

<?php
/**
 * 
 */
class customer
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this -> db = new database();
		$this -> fm = new format();
	}
	public function insert_customers($data){
      $name = mysqli_real_escape_string($this->db->link, $data['name']);  
      $emailguest = mysqli_real_escape_string($this->db->link, $data['emailguest']);
      $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $address = mysqli_real_escape_string($this->db->link, $data['address']);  
      $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
      $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
   if($name=="" || $email== "" || $address== "" || $phone== "" || $password==""){
      $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
      return $alert;
             
	}else{
      $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1 ";
      $result_check = $this->db->select($check_email);
      if($result_check){
         $alert = "<span class='error'>Email đã tồn tại</span>";
         return $alert;
      }else{
         $query = "INSERT INTO tbl_customer (name,emailguest,email,address,phone, password) VALUES('$name','$emailguest','$email','$address','$phone','$password')";
         $result = $this->db->insert($query);	
         if($result==true){
            $alert="<span class='success'> Tạo mới khách hàng thành công</span>";
            return $alert;
         }
         else{
            $alert="<span class='error'> Tạo mới khách hàng không thành công</span>";
            return $alert;
         }
      }
   }
}
   public function login_customers($data){
      $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
      if($email=="" || $password==""){
         $alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng! Vui lòng nhập lại</span>";
         return $alert;
             
	   }else{
         $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password = '$password' LIMIT 1 ";
         $result_check = $this->db->select($check_login);
         if($result_check != false){
            $value	= $result_check->fetch_assoc();
            Session::set('customer_login', true);
            Session::set('customer_Id', $value['Id']);
            Session::set('customer_name', $value['name']);
            header('Location:index.php');
         }else{
            $alert = "<span class='error'>Email hoặc mật khẩu không tồn tại</span>";
            return $alert;
         }
	   }
   }
   public function show_customers($Id){
      $query = "SELECT * FROM tbl_customer WHERE Id='$Id'";
      $result = $this->db->select($query);
      return $result;
   }
   public function update_customers($data, $Id){
      $name = mysqli_real_escape_string($this->db->link, $data['name']);
      $email = mysqli_real_escape_string($this->db->link, $data['email']);
      $address = mysqli_real_escape_string($this->db->link, $data['address']);
      $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
      if($name=="" || $email== "" || $address== "" || $phone== ""){
         $alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
      return $alert;
             
      }else{
         $query = "UPDATE tbl_customer SET name='$name',email='$email',address='$address',phone='$phone' WHERE Id = '$Id'";
         $result = $this->db->insert($query);   
         if($result==true){
            $alert="<span class='success'> Cập nhật khách hàng thành công</span>";
            return $alert;
         }
         else{
            $alert="<span class='error'> Cập nhật khách hàng không thành công</span>";
            return $alert;
         }
      }
   }
}
?>


