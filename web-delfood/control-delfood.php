<?php
ob_start();
 include_once 'model-delfood.php';

 class delfood extends model
 {
    public function __construct()
    {
        parent ::__construct();
        session_start();
        $url=$_SERVER ['PATH_INFO'];
        $data =$this->selectAll ("country1");
       // echo $url;
        switch($url)
        {
            case '/index';
            include_once 'header-delfood.php';

           // $data =$this->selectAll ("country1");
             //insert data
            if(isset($_POST['submit']))
            {
                $name= $_POST['name'];
                $phone= $_POST['phone'];
                $email= $_POST['email'];
                $password= $_POST['pwd'];
                $gender= $_POST['gender'];
                $date= $_POST['date'];
                $hobbies =$_POST['hobbies'];
                $h = implode(",",$hobbies);
                $Education =$_POST['Education'];
                $address =$_POST['address'];
                $country= $_POST['country1'];

                $data =array('name'=>$name,
                            'phone'=>$phone,
                            'email'=>$email,
                            'password'=>$password,
                            'gender'=>$gender,
                            'dateofbirth'=>$date,
                            'hobbies'=>$h,
                            'Education'=>$Education,
                            'address'=>$address,
                            'country'=>$country);
             $this->InsertData("register1",$data);       

            }
            
            include_once 'register-delfood.php';
            include_once 'footer-delfood.php';
            break;

            case '/login' :
                include_once 'header-delfood.php';
                if(isset($_POST['login']))
                {
                    $email =$_POST['emailid'];
                    $password =$_POST['password'];

                    $where =array('emailid'=>$email,'password'=>$password);
                    $fdata =$this->select_where('register',$where);
                    $g=$fdata->num_rows;
                    if($g>0)
                    {
                        $e =$fdata->fetch_object();
                        $em =$e->emailid;
                       // header('location:profile?emailid='.$em);
                      $_SESSION['user']=$e->id;
                       $_SESSION['name']=$e->name;
                     // echo $_SESSION['name']; exit;
                       if(isset($_POST['remember']))
                       {
                          setcookie('email',$email,time()+3600);
                          setcookie('password',$password,time()+3600);
                       }

                       header('location:product');
                    }
                    else 
                    {
                        echo "<script>alert('Invalid data !')</script>";
                    }
                }
                include_once 'login-delfood.php';
                include_once 'footer-delfood.php';
                break;

                //forgot
                case '/forgot':
                 
                include_once 'header-delfood.php';
                    if(isset($_POST['emailid']))
                    {
                        $forgot=$_POST['emailid'];
                        $where=array('emailid'=>$forgot);
                        $odata=$this->select_where("register",$where);
                        $alldata=$odata->fetch_object();
                        echo $alldata->password; exit;
                        header('location:login');
                    }
                include_once 'forgot-delfood.php';   
                include_once 'footer-delfood.php';
                break;  
                
                //change password
                case '/change':
                    include_once 'header-delfood.php';
                    if(isset($_POST['change']))
                    {
                         $emailid=$_POST['emailid'];
                         $oldpassword=$_POST['Oldpassword'];
                         $newpassword=$_POST['newpassword'];

                         $data=array('password'=>$newpassword);
                         $where=array('emailid'=>$emailid,'password'=>$oldpassword);
                         $odata=$this->select_where("register",$where);
                         $alldata=$odata->fetch_object();

                         $this->updatedata('register',$data,$where);

                    }
                    else 
                    {
                        echo "<script>alert('Not enter new password !');</script>";  
                    }
                    include_once 'change-delfood.php';
                    include_once 'footer-delfood.php';
                break;    

                //profile
                case '/profile' :
                include_once 'header-delfood.php';
                if(isset($_GET['emailid']))
                {
                    $ema =$_GET['emailid'];
                    $where=array('emailid'=>$ema);
                    $odata=$this->select_where('register',$where);
                    $alldata =$odata->fetch_object();
                }
                include_once 'profile-delfood.php';
                include_once 'footer-delfood.php';  
                break; 
                

                //product

                case '/product' :
                    if(isset($_SESSION['name']))
                    {
                    include_once 'header-delfood.php';
                    $allpro = $this->selectAll('product1');
                    if(isset($_POST['addtocart']))
                    {
                        $uid= $_SESSION['user'];
                        $pid= $_POST['pid'];
                        $qty= $_POST['qty'];

                        $data= array('user_id'=>$uid,'pro_id'=>$pid,'qty'=>$qty);
                        $pro_data=$this->InsertData('cart1',$data);
                        echo "<script>alert('data added in cart successfully !');</script>";
                    }
                    include_once 'product-delfood.php';
                    include_once 'footer-delfood.php';
                    }
                    else 
                    {
                       header('location:login');
                    }
                    break;

                    //logout
                    case '/logout' :
                        session_destroy();
                        header('location:login');
                    break;    
                    
                    //join
                    case '/showcart' :
                        include_once 'header-delfood.php';
                        $cart=$this->Join_Two('cart1','product1','cart1.pro_id=product1.pro_id');
                        include_once 'showcart-delfood.php';
                        include_once 'footer-delfood.php';
                    break;    
                    
                    //payment
                    case '/paytm-payment' :
                        include_once 'header-delfood.php';
                        $paytm=$this->Join_Two('cart1','product1','cart1.pro_id=product1.pro_id');
                        include_once 'paytm-payment.php';
                        include_once 'footer-delfood.php';
                    break;  

                    //about
                    case '/about' :
                        include_once 'header-delfood.php';
                       
                       
                          $allab = $this->selectAll('about1');
                       
                      include_once 'about-delfood.php';
                      include_once 'footer-delfood.php'; 
                  break;  
                    
                    //contact
                    case '/contact':
                        include_once 'header-delfood.php';
                        if(isset($_POST['Send']))
                        {
                            $name=$_POST['name'];
                            $email=$_POST['email'];
                            $phone=$_POST['phone'];
                            $subject=$_POST['subject'];
                            $data =array( 'name'=>$name,
                                          'email'=>$email,
                                           'phone'=>$phone,
                                           'subject'=>$subject);
                                       //  print_r($data); exit;
                        $this->InsertData("contact1",$data);
                        }
                        include_once 'contact.php';
                        include_once 'footer-delfood.php';


        }
    }
 }
$obj = new delfood;

 ob_flush();
?>