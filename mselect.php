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
	
	$('#search').on('change, keyup', function(){
		var searched = $(this).val().toLowerCase();
		res = "";
		for(var i=0; i<opton.length; i++)
		{
			var optonTxt = opton[i].toLowerCase();
			if(optonTxt.indexOf(searched) >= 0)
			{
				var a = "aclick('"+vale[i]+"','"+opton[i]+"')";
				var clas = "";
				if(i == 0)	{	clas = "selected";	}
				res += '<a class="resa" onclick='+a+' value="'+vale[i]+'"><li class="'+clas+'">'+opton[i]+'</li></a>';
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
	});

	$('#show_all').on('click', function(){
		res = "";
		for(var i=0; i<opton.length; i++)
		{
			var a = "aclick('"+vale[i]+"','"+opton[i]+"')";
			var clas = "";
			if(i == 0)	{	clas = "selected";	}

			res += '<a class="resa" onclick='+a+' value="'+vale[i]+'"><li class="'+clas+'">'+opton[i]+'</li></a>';
		}

		if(res != "")
		{
			res = '<div class="services"><ul>'+res+'</ul></div>';
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

</script>

</html>

<style>

.services {
    display:none;   
}

.services li {
    width: 150px;   
}

.services li.selected {
    background-color: grey;   
}

</style>

<input type="text" id="autofill"/> Press enter to view items
<div class="services">
    <div class="items">
        <ul>                           
            <li class="mail-icon selected"><a href="#" id="mail">mail</a></li>
            <li class="forum-icon"><a href="#" id="forum">lang</a></li>
            <li class="chat-icon"><a href="#" id="chat">chat</a></li>
        </ul>
    </div>
</div>

<script>

$("#search").keydown(function(e) {
    if (e.keyCode == 13) { // enter
        if ($(".services").is(":visible")) {
            selectOption();
        } else {
            $(".services").show();
        }
        menuOpen = !menuOpen;
    }
alert(e.keyCode);
    if (e.keyCode == 38) { // up
        var selected = $(".selected");
        $(".services li").removeClass("selected");
        if (selected.prev().length == 0) {
            selected.siblings().last().addClass("selected");
        } else {
            selected.prev().addClass("selected");
        }
    }
    if (e.keyCode == 40) { // down
alert('down');
        var selected = $(".selected");
        $(".services li").removeClass("selected");
        if (selected.next().length == 0) {
            selected.siblings().first().addClass("selected");
        } else {
            selected.next().addClass("selected");
        }
    }
});

$(".services li").mouseover(function() {
    $(".services li").removeClass("selected");
    $(this).addClass("selected");
}).click(function() {
    selectOption();
});

function selectOption() {
    $("#autofill").val($(".selected a").text());
    $(".services").hide();
}

</script>

