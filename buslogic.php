<?php
include_once 'config.php';
class clscat
{
    public $catcod,$catnam;
    function save_cat()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call inscat('$this->catnam')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function update_cat()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call updcat('$this->catcod','$this->catnam')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function delete_cat()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call delcat('$this->catcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
     
    function find_cat()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call fndcat('$this->catcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_num_rows($res)>0)
        {
            $r=  mysqli_fetch_array($res);
            $this->catcod=$r[0];
            $this->catnam=$r[1];
        }
        $con->db_close();
    }
    function disp_cat()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dspcat()";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
        return $arr;
        $con->db_close();
    }
    
}
class clsusr
{
    public $usrcod,$usreml,$usrpwd,$usrregdat;
    
    function logincheck($eml,$pwd)
    {
         $con=new clscon();
        $link=$con->db_connect();
        $qry="call logincheck('$eml','$pwd',@cod)";
        $res=  mysqli_query($link, $qry);
        $res1=  mysqli_query($link,"select @cod");
        $r=mysqli_fetch_row($res1);
        $con->db_close();
        return $r[0];
    }
    
    function save_usr()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call insusr('$this->usreml','$this->usrpwd','$this->usrregdat')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function update_usr()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call updusr('$this->usrcod','$this->usreml','$this->usrpwd','$this->usrregdat')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function delete_usr()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call delusr('$this->usrcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }  
    function find_usr()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call fndusr('$this->usrcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_num_rows($res)>0)
        {
            $r=  mysqli_fetch_array($res);
            $this->usrcod=$r[0];
            $this->usreml=$r[1];
            $this->usrpwd=$r[2];
            $this->usrregdat=$r[3];
        }
        $con->db_close();
    }
    function disp_usr()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dspusr()";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
        return $arr;
        $con->db_close();
    }
    
}
class clstrk
{
    public $trkcod,$trkcatcod,$trklyr,$trkdsc,$trkfil,$trkuplusrcod,$trkupldat;
    function save_trk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call instrk('$this->trkcatcod','$this->trklyr','$this->trkdsc','$this->trkfil','$this->trkuplusrcod','$this->trkupldat',@cod)";
        $res=  mysqli_query($link, $qry);
        $res1=mysqli_query($link,"select @cod");
        $r=  mysqli_fetch_row($res1);
        $con->db_close();
        return $r[0];
    }
    function update_trk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call updtrk('$this->trkcod','$this->trkcatcod','$this->trklyr','$this->trkdsc','$this->trkfil','$this->trkuplusrcod','$this->trkupldat')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function delete_trk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call deltrk('$this->trkcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function find_trk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call fndtrk('$this->trkcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_num_rows($res)>0)
        {
            $r=  mysqli_fetch_array($res);
            $this->trkcod=$r[0];
            $this->trkcatcod=$r[1];
            $this->trklyr=$r[2];
            $this->trkdsc=$r[3];
            $this->trkfil=$r[4];
            $this->trkuplusrcod=$r[5];
            $this->trkupldat=$r[6];
        }
        $con->db_close();
    }
    
    function disp_trk($catcod)
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dsptrk('$catcod')";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
        return $arr;
        $con->db_close();
    }
    function dspforplylst($ccod,$pcod)
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dspforplylst('$ccod','$pcod')";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
        return $arr;
        $con->db_close();
    }
    
}
class clsplylst
{
    public $plylstcod,$plylstdat,$plylstusrcod,$plylsttit,$plylstdsc,$plylstcatcod,$plylstlik;
    function save_plylst()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call insplylst('$this->plylstdat','$this->plylstusrcod','$this->plylsttit','$this->plylstdsc','$this->plylstcatcod','$this->plylstlik',@cod)";
        $res=  mysqli_query($link, $qry);
        $res1=  mysqli_query($link,"select @cod");
        $r=  mysqli_fetch_row($res1);
        $con->db_close();
        return $r[0];
    }
    function update_plylst()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call updplylst('$this->plylstcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function delete_plylst()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call delplylst('$this->plylstcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
     
    function find_plylst()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call fndplylst('$this->plylstcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_num_rows($res)>0)
        {
            $r=  mysqli_fetch_array($res);
            $this->plylstcod=$r[0];
            $this->plylstdat=$r[1];
            $this->plylstusrcod=$r[2];
            $this->plylsttit=$r[3];
            $this->plylstdsc=$r[4];
            $this->plylstcatcod=$r[5];
            $this->plylstlik=$r[6];
        }
        $con->db_close();
    }
    function dspplylstbycat($ccod)
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dspplylstbycat('$ccod')";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
         $con->db_close();
        return $arr;
       
    }
    
}
class clsplylsttrk
{
    public $plylsttrkcod,$plylstplylstcod,$plylsttrktrkcod,$plylsttrkord;
    function save_plylsttrk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call insplylsttrk('$this->plylstplylstcod','$this->plylsttrktrkcod','$this->plylsttrkord')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function update_plylsttrk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call updplylsttrk('$this->plylsttrkcod','$this->plylstplylstcod','$this->plylsttrktrkcod','$this->plylsttrkord')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
    function delete_plylsttrk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call delplylsttrk('$this->plylsttrkcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_affected_rows($link)==1)
        {
            return TRUE;
            $con->db_close();
        }
        else
        {
            return FALSE;
            $con->db_close();
        }
    }
     
    function find_plylsttrk()
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call fndplylsttrk('$this->plylsttrkcod')";
        $res=  mysqli_query($link, $qry);
        if(mysqli_num_rows($res)>0)
        {
            $r=  mysqli_fetch_array($res);
            $this->plylsttrkcod=$r[0];
            $this->plylstplylstcod=$r[1];
            $this->plylsttrktrkcod=$r[2];
            $this->plylsttrkord=$r[3];
            
        }
        $con->db_close();
    }
    function disp_plylsttrk($pcod)
    {
        $con=new clscon();
        $link=$con->db_connect();
        $qry="call dspplylsttrk('$pcod')";
        $res=  mysqli_query($link, $qry);
        $arr=array();
        $i=0;
        while ($r=  mysqli_fetch_row($res))
        {
            $arr[$i]=$r;
            $i++;
        }
        return $arr;
        $con->db_close();
    }
    
}

?>