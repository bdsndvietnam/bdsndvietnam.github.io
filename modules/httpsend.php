<?php
if (is_array($_GET['post']) || is_array($_GET['p']))
{
insert($_GET['post'],"thanhvien");
insert($_GET['p'],"dondathang");
echo "insert to database!";
}
else 
echo "Not insert";
?>