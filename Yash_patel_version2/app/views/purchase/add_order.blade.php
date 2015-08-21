@extends('layouts.main')
@section('content')
@extends('includes/sidebar')

<!DOCTYPE html>
<html>
<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style >
#Table{

   position: fixed;
    top: 200px;
    right: 25px;
}

#order{
  position: relative;
}
</style>
<script>


function modify_supplier(event) {
  var a = document.getElementById("text_input");
  a.value = event.target.innerHTML;
  
}
function modify_location(event) {
  var a = document.getElementById("location_input");
  a.value = event.target.innerHTML;
  
}
function modify_items(event) {
  var a = document.getElementById("item_input");
  var input = a.value;
  var b=a.value;



  var l=event.target.innerHTML;
  var c= "";
  for(i=0; i<l.length; i++)
  {
      if(l[i]==" " && l[i+1]=="Q")
      {
        var j=i;
        while(l[j-1]!=" ")
        {
          j-=1;
        }
        while(j != i)
        {
          c+=l[j];
          j+=1;
        }
        
      }

        
  }

var d = a.value;

  for (var i=d.length;i>=0;i--)

  {
    if(d[i] == ',')
    {
      b="";
      for(var j=0;j<=i;j++)
      {
        b += d[j];
      }
      break;
    }

    else if(i==0)
    {
      b="";
    }


  } 
  var quan = document.getElementById("qq").value;
  if(quan)
  {
    quan = "{" + quan + "}";
  }
a.value=b + c + quan  ;
}

function get_supplier()
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    Info_Title=xmlhttp.responseText;
    json_output=eval("("+Info_Title+")");

   var myNode = document.getElementById("display_supplier");
     while (myNode.firstChild)
      {
           myNode.removeChild(myNode.firstChild);
      } 

        for (var i in json_output)
        {
              var temp=json_output[i];
              var div = document.createElement('div');
              var t="supplier" + i;
              div.id = t;
              div.innerHTML=temp;
              
              document.getElementById("display_supplier").appendChild(div)                
              
              var sup = document.getElementById(t);
              sup.addEventListener("click", modify_supplier , false);
              document.getElementById("display_supplier").appendChild(div)                
        
        }

    }
  }
  var user_input=document.getElementById("text_input").value
xmlhttp.open("GET","search_supplier?in="+user_input,true);
xmlhttp.send();
}

function get_items()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    Info_Title=xmlhttp.responseText;
    json_output=eval("("+Info_Title+")");
    //alert(json_output);

   var myNode = document.getElementById("display_items");
     while (myNode.firstChild)
      {
           myNode.removeChild(myNode.firstChild);
      } 


      x= <?php $items = DB::table('inventory_items')->get(); 
    echo json_encode($items);
    ?>;



        for (var i in json_output)
        {
              var temp=json_output[i];
              var div = document.createElement('div');
              var t=item + i;
              div.id=t;
             /* var body = document.body;
              var tbl=document.createElement('table');
              tbl.style.width='100px';
              tbl.style.border = "1px solid black";*/
             for ( var j=0 ; j<x.length ; j++)
              {
               // var tr = tbl.insertRow();
                
                if (x[j]['part_descriptions'] == temp)
                {
                  /*var td = tr.insertCell();
                  td.appendChild(document.createTextNode(x[j]['item_code']));
                  
                  td.style.border = "1px solid black";
                  td = tr.insertCell();
                  td.appendChild(document.createTextNode(temp));
                  td.style.border = "1px solid black";      */
                  
               div.innerHTML= x[j]['item_code'] + " " + temp + " " + 'Quantity : <input id="qq" size=1>';
            
                }
                //alert(x[j]['part_descriptions']);
              }
              
              
              document.getElementById("display_items").appendChild(div);                
        
              var sup = document.getElementById(t);
              sup.addEventListener("click" , modify_items , true);
              
              document.getElementById("display_items").appendChild(div)                
        
        }
        //body.appendChild(tbl);

    }
  }
  var user_input=document.getElementById("item_input").value
  var item = user_input;
  var count=parseInt("0");
  for(var i=0; i<user_input.length; i++) 
  {
    if(user_input[i] == ',')
       {
        count = count + 1;
        var flag=parseInt("1");
        var j = parseInt(i);
      }
      if(flag == 1)
      {
       item   = "";
       item += user_input[i];          
      }

  }
  
xmlhttp.open("GET","search_item?in="+item,true);
xmlhttp.send();
}

function save_order()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("done").innerHTML=xmlhttp.responseText;
    }
  }
  var loc=document.getElementById("location_input").value;
  var curr_user = window.user;
  var cmnt=document.getElementById("comment").value ;
  var all = document.getElementById("text_input").value;
  all += ",";
  all += document.getElementById("item_input").value;

xmlhttp.open("GET","save_order?in="+all+"&usr="+curr_user+"&location="+loc+"&cmnt="+cmnt,true);
xmlhttp.send();
}
window.count=0;



function get_location()
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    Info_Title=xmlhttp.responseText;
    json_output=eval("("+Info_Title+")");
    //alert(json_output);

   var myNode = document.getElementById("display_location");
     while (myNode.firstChild)
      {
           myNode.removeChild(myNode.firstChild);
      } 
      window.which_fun = "location";

        for (var i in json_output)
        {//alert(i);
              var temp=json_output[i];
              var div = document.createElement('div');
              var t = "loc" + i;
              div.id= t;
              div.innerHTML=temp;
              
              document.getElementById("display_location").appendChild(div)                
        
              var sup = document.getElementById(t);
              sup.addEventListener("click", modify_location , false);
              document.getElementById("display_location").appendChild(div)                
              
        }

    }
  }
  var user_input=document.getElementById("location_input").value
xmlhttp.open("GET","search_location?in="+user_input,true);
xmlhttp.send();
}

function changeColor(elem)
{
if(window.count == 0)  
{elem.style.backgroundColor = "yellow";
window.user = elem.innerHTML;
//alert(window.user);
} 
window.count=1;
}


</script>
</head>
<body>
  <?php 
   $max_id = DB::table('purchase_orders')->where('id', DB::raw("(select max(`id`) from purchase_orders)"))->get();
    $x = json_encode($max_id);

    $z = 0;
    $y = NULL;
    for($i=0 ; $i<strlen($x); $i++)
    {
      if($x[$i] == '"')
        {
          $z += 1;
        }
      if($z == 3)
      {
        while($x[$i + 1] != '"' )
        {
          $y = $y.$x[$i + 1];
          $i += 1;
        }
      }


    }

  ?>
<section class="">
  <section class = "wrapper">
  @include("errors.global_alert_messages")
  <div class = "row" >
  <div class = "col-lg-12">
  <section class="panel">
    <header class="panel-heading">
    ADD PURCHASE ORDER
    <h5>Purchase Order id {{ $y + 1 }}</h5>
    </header>
    <div class="panel-body">
<div id="supplier"><h3>Supplier *</h3></div>
<form id="form_id">
    <!-- Put your fields here -->
    <input id="text_input" type="text" onkeyup="get_supplier()">
</form>

<div id="display_supplier"> </div>

<div id="locations"><h3>Location Warehouse *</h3></div>
<form id="form_id">
    <!-- Put your fields here -->
    <input id="location_input" type="text" onkeyup="get_location()">
   
</form>
<div id="display_location"> </div>

<div id="items"><h3>Items *</h3></div>
<form id="form_id">
    <!-- Put your fields here -->
    <input id="item_input" type="text" onkeyup="get_items()">
   
</form>


<div id="display_items"></div>

<textarea id="comment" placeholder="Add Comments :)" rows="4" cols="50"></textarea>
<button id="order" type="button" class="btn btn-success" onclick="save_order()">Order</button>
<div id="done"> </div>

  <?php 
$categories = DB::table('users')->get();
?>

<div align='center' id='Table'>
    <p>Order Initiated by?</p>
    
  <?php
    $category_selector = array();
    foreach($categories as $category)
    {
      $category_selector[$category->username] = $category->username;
    }
  ?>
  
  {{Form::select('usr',$category_selector)}}
  </div>
  </section>
  </div>
  </div>

  </section>
</section>
@stop

</body>
</html>
