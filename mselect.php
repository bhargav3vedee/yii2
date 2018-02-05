<html>

<head>

<style>

ul {
    padding: 2;
    list-style-type: none;
}
li {
	padding-top : 5px;
	padding-left: 2px;
}

</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>

<body>

<div class="container">
	<div class="col-sm-6">
		<select class="mselect form-control" id="mselect1">
			<option value="one">One</option>
			<option value="two">Two</option>
			<option value="three">Three</option>
                        <option value="four">Four</option>
                        <option value="five">Five</option>
                        <option value="six">Six</option>
                        <option value="seven">Seven</option>
                        <option value="eight">Eight</option>
		</select>
	</div>
</div>

</body>

<script type="text/javascript">

var opton = [];
var vale = [];
var res = "";
var selVal = "";
var selTxt = "";
var max = 0;
var child = 0;

$(document).ready(function(){

	$('#mselect1').parent().attr('id','resList');
	$('#mselect1').hide();

	$('#mselect1 option').each(function(){
		opton.push($(this).text());
		vale.push($(this).val());
	});

	var frmGrp = '<div class="input-group">'+
                        '<input type="text" class="mselect form-control" placeholder="Search for..." id="search">'+
                        '<span class="input-group-btn">'+
                            '<button class="mselect btn btn-secondary" id="show_all" type="button">Go!</button>'+
                        '</span>'+
	    	     '</div>'+
		     '<div id="res_list" style="position : absolute; width:95%; z-index: 9999;background-color:red; display:none; max-height: 100px; overflow-y: scroll;"></div>';

	$('#resList').append(frmGrp);
	
	$('#search').on('keyup', function(e){
            
		var searched = $(this).val().toLowerCase();
		res = "";
                var locali = 0; max = 0;
		for(var i=0; i<opton.length; i++)
		{
                    var optonTxt = opton[i].toLowerCase();
                    if(optonTxt.indexOf(searched) >= 0)
                    {
                            var a = "aclick('"+vale[i]+"','"+opton[i]+"')";
                            var clas = "";
                            if(locali == 0)	{	clas = "selected";  locali++;	}
                            res += '<li onclick='+a+' style="cursor: pointer;" class="'+clas+'"><a class="resa" onclick='+a+' data-value="'+vale[i]+'">'+opton[i]+'</a></li>';
                            max++;
                    }
		}
                

		if(res != "")
		{
                    res = '<ul id="res_option">'+res+'</ul>';
                    $('#res_list').show();
                    $('#res_list').html(res);
		}
		else
		{
                    res = '<ul id="res_option">No Results Found</ul>';
                    $('#res_list').show();
                    $('#res_list').html(res);
		}
                
                traverse(e.keyCode);
                
	});

	$('#show_all').on('click', function(){
            res = "";
            var localp = 0;
            for(var i=0; i<opton.length; i++)
            {
                    var a = "aclick('"+vale[i]+"','"+opton[i]+"')";
                    var clas = "";
                    if(localp == 0)	{	clas = "selected";  localp++;	}

                    res += '<li style="cursor: pointer;" onclick='+a+' class="'+clas+'"><a class="resa" onclick='+a+' data-value="'+vale[i]+'">'+opton[i]+'</a></li>';
            }

            if(res != "")
            {
                res = '<ul id="res_option">'+res+'</ul>';
                $('#res_list').show();
                $('#res_list').html(res);
            }
            else
            {
                res = '<ul id="res_option">No Results Found</ul>';
                $('#res_list').show();
                $('#res_list').html(res);
            }
	});

	$(document).click(function(event) {
		var clsName = event.target.className;
		if(clsName == "resa" || clsName == "mselect" || clsName == "mselect btn btn-secondary")
		{
		}
		else
		{
                    $('#res_list').hide();
                    var selected = $('#search').val();

                    if(opton.indexOf(selected) == -1 )
                    {
                            $('#search').val('');
                    }
		}
    	});

});

function aclick(val, txt)
{
	selVal = val;
	selTxt = txt;
	$('#mselect1').val(val);
	$('#search').val(txt);
	$('#res_list').hide();
}

function traverse(kCode)
{   
    if(kCode == 13)
    {
        var atxt = document.querySelector('#res_option li:nth-child('+child+')').innerText;
        var atag = document.querySelector('#res_option li:nth-child('+child+')').innerHTML;
        var va = atag.split('value="');
        var vs = va[1].split('">');
        $('#mselect1').val(vs[0]);
        $('#search').val(atxt);
        $('#res_list').hide();
    }
    
    if(kCode == 40 || kCode == 38)
    {
        if(kCode == 40)
        {
            if(child <= max)    { child++;  }
            else { child = 1; }
            $("#res_option li:nth-child("+child+")").css("background-color", "white");
            var p = child -1;
            $("#res_option li:nth-child("+p+")").removeClass('selected');
            $("#res_option li:nth-child("+child+")").addClass('selected');
            var offset = $('#res_option ul li').first().position().top;
            alret(offset);
        }
        else if(kCode == 38)
        {
            if(child == 0)  { child = max;}
            else {  child--;    }
            $("#res_option li:nth-child("+child+")").css("background-color", "white");
            var p = child+1;
            $("#res_option li:nth-child("+p+")").removeClass('selected');
            $("#res_option li:nth-child("+child+")").addClass('selected');
        }
    }
}

</script>

</html>
