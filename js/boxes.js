
var boxItem_open=false;
var boxItem_separate=110;

var boxItem_count=0;

var boxItemId1=0;
var boxItemId2=0;
var boxItemId3=0;
var boxItemId4=0;
var boxItemId5=0;

var boxId=0;
var boxTier=0;
var cursorX=0;
var cursorY=0;
var itemsCatch;
var MyItemsCatch;
var ItemMatch = new Array();
var especialBox;
boxDestroyDone=()=>{
  loadRecomensas();
}
boxDestroyingAll =()=>{
  jConfirm("Desea realmente destruir TODAS LAS CAJAS?", 'DESTRUIR TODO', function(r) {
    if(r)
    {
      $.ajax({
        data: "id="+idPersonaje,
        type: "GET",
        dataType: "json",
        url: "json/boxDestroyAll.php",
        success: function(){
        boxDestroyDone();
      }
      });
    }
  }
  );
}
boxDestroying =(id)=>{
  jConfirm("Desea realmente destruir la caja?", 'Destruir Caja', function(r) {
		if(r)
		{
      $.ajax({
        data: "id="+id,
        type: "GET",
        dataType: "json",
        url: "json/boxDestroy.php",
        success: function(){
        boxDestroyDone();
      }
      });
    }
  }
  );
}

showItemWith = (data,i)=>{
  $( "#comparation"+i ).text("");

  var dat = data.split('|');

  $( "#comparation"+i ).append(
        '<div class="ComparationItem" style="width: 275px; left: 671px; z-index: 9999; top: 390px; box-shadow: rgba(0, 0, 0, 0.5) 1px 1px 6px;" ><div class="cluetip-outer" style="position: relative; z-index: 97; overflow: visible; height: auto;"><h3 class="cluetip-title ui-widget-header ui-cluetip-header comparetitleType">DROP</h3><h3 class="cluetip-title ui-widget-header ui-cluetip-header comparetitle">'+dat[0]+'</h3><div class="cluetip-inner ui-widget-content ui-cluetip-content">'+dat[1]+'</div></div></div></div><div class="cluetip-extra"></div></div>'
    );
  var key = itemsCatch[i]['tipo'];
  if(ItemMatch[key]!=null)
  {
    var matchup=ItemMatch[key];
        if(MyItemsCatch[matchup]['enchant']>0)
          enchant=" +"+MyItemsCatch[matchup]['enchant'];
        else
          enchant=""; 
             title= MyItemsCatch[matchup]['Nombre']+enchant+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(MyItemsCatch[matchup],"<br>")+"</div>";
             
            if(MyItemsCatch[matchup]['armorset']>0)
            {
               idItemTrue = MyItemsCatch[matchup]['armorset'];
               title+= "<div class=ComunDescSet><div class=SetName>Set "+MyItemsCatch[matchup]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
               title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
            }
     dat = title.split('|');       
    $( "#comparation"+i ).append(
          '<div class="ComparationItem" style="width: 275px; left: 671px; z-index: 9999; top: 390px; box-shadow: rgba(0, 0, 0, 0.5) 1px 1px 6px;" ><div class="cluetip-outer" style="position: relative; z-index: 97; overflow: visible; height: auto;"><h3 class="cluetip-title ui-widget-header ui-cluetip-header comparetitleType">EQUIPADO</h3><h3 class="cluetip-title ui-widget-header ui-cluetip-header comparetitle">'+dat[0]+'</h3><div class="cluetip-inner ui-widget-content ui-cluetip-content">'+dat[1]+'</div></div></div></div><div class="cluetip-extra"></div></div>'
      );
  }
}


function ComparerMouseOver(id) {
  CompareMouseOut();

  $( "#comparation"+id ).show();
}

function CompareMouseOut() {
  for(var i=0;i<5;i++)
    $( "#comparation"+i ).hide();
}

function boxOpeningDone(data)
{
    itemsCatch = data.litem;
    var i=0;
    var desc="";
    var setInfo="";
    var title="";
    var idItemTrue=0;
    var itemOptions="";
    var romper ="";
    var idShow=1;
    boxTier=data['boxTier'];
    especialBox=parseInt(data['special']);
    $( "#showItem_boxUnopen" ).text("");
    switch(especialBox)
    {
      case 1:
       $( "#showItem_boxUnopen" ).append('<img src="images/boxes/santa_close.png" alt="Caja"  />');
      break;
      default:
       $( "#showItem_boxUnopen" ).append('<img src="images/boxes/tier'+boxTier+'_close.png" alt="Caja"  />');
      break;
    }
  

    while(itemsCatch[i])
      {
        setInfo= "setInfo"; 
      
        title= itemsCatch[i]['Nombre']+"|<div class=ComunDesc>Atributos:<br>"+makeDesc(itemsCatch[i],"<br>")+"</div>";
         
        if(itemsCatch[i]['armorset']>0)
        {
           idItemTrue = itemsCatch[i]['armorset'];
           title+= "<div class=ComunDescSet><div class=SetName>Set "+itemsCatch[i]['Nombre']+"</div><div class=raidDrop>Requiere:<br>"+descArmor[idItemTrue]['req']+"</div>";
           title+= "<div>Bonus:<br>"+descArmor[idItemTrue]['desc']+"</div></div>";
        }       
  
         $("#SD_drop"+idShow).text("");
         showItemWith(title,i);
         $("#SD_drop"+idShow).append("<div onmouseover='ComparerMouseOver("+i+");' onmouseleave='CompareMouseOut()' class='item_img_drop dropItems "+setInfo+"' id='"+i+"'><img src='images/item/"+itemsCatch[i]['subtipo']+"/"+itemsCatch[i]['imagen']+"' /></div>");
         $("#SD_drop"+idShow).attr("itemId",itemsCatch[i]['idBoxDrop']);
          idShow++;
        i++;
      }
   //$('.dropItems').cluetip({splitTitle: '|',delayedClose: 0,cursor:'pointer'});
   $("#showItem_box").show("slow");
}
function boxOpening(id)
{
  boxId=id;
  boxItem_open=false;
  $( "#showItem_boxUnopen" ).text("");
  $( "#showItem_boxUnopen" ).append('<img src="images/477.gif" alt="Cargando"  />');
   $( "#showItem_boxUnopen" ).css('top','90px');
   $("#showItem_dropItems").hide();

  $( "#SD_drop1, #SD_drop2, #SD_drop3, #SD_drop4, #SD_drop5" ).
  removeClass("showItem_dropBox_selected").addClass("showItem_dropBox");

  boxItemId1=0;
  boxItemId2=0;
  boxItemId3=0;
  boxItemId4=0;
  boxItemId5=0;
boxItem_count=0;
//alert("json/boxOpen.php?id="+id);
  $.ajax({
        data: "id="+id,
        type: "GET",
        dataType: "json",
        url: "json/boxOpen.php",
        success: function(data){
        boxOpeningDone(data);
      }
      });
}
showMyShit = (data)=>{
 /* if(data['leg'])
    {
      $("#chatImputer").val("DROP {item} :o");
      mostrarItemId=data['leg'];
      mostrarItemName=data['legName'];
      enviarMsg();
    }*/
}

function itemlist(data) {
    $("#error").text(data['error']);
    MyItemsCatch = data.litem;
    var i=0;
    var mewINdex=0;
    while(MyItemsCatch[i])
      {
        if(MyItemsCatch[i]['usadoPor'] == idPersonaje)
        {
            ItemMatch[MyItemsCatch[i]['tipo']]=i;
            mewINdex++;
        }
          i++;
       }
} 

function checkItems()
  {
    $.ajax({
      data: "",
      type: "GET",
      dataType: "json",
      url: "json/myItems.php",
      success: function(data){
      itemlist(data);
    }
    });
  }
$(document).ready(function(){ 

checkItems();


  $( "#showItem_close" ).click(function()
    {
       $("#showItem_box").hide("slow");
    });

    $( "#SD_GET_BUT" ).click(function()
    {
       // alert("boxItemId1:"+boxItemId1+" boxItemId2:"+boxItemId2+" boxItemId3:"+boxItemId3+"boxItemId4:"+boxItemId4+" boxItemId5:"+boxItemId5)
       // $( "#SD_GET_BUT" ).text("json/boxGetThings.php?box="+boxId+"&item1="+boxItemId1+"&item2="+boxItemId2+"&item3="+boxItemId3+"&item4="+boxItemId4+"&item5="+boxItemId5)
        if(boxItemId1==0 && boxItemId2==0 && boxItemId3==0 && boxItemId4==0 && boxItemId5==0   )
        {
          jAlert("Elije al menos un item!", 'ERROR: Conseguir items');	
        }
        else
        {
          $("#showItem_box").hide("slow");
          if ( $( "#Recompensas_id"+boxId ).length ) {
              $( "#Recompensas_id"+boxId ).hide("slow");
          }

          $.ajax({
            data: "box="+boxId+"&item1="+boxItemId1+"&item2="+boxItemId2+"&item3="+boxItemId3+"&item4="+boxItemId4+"&item5="+boxItemId5,
            type: "GET",
            dataType: "json",
            url: "json/boxGetThings.php",
            success: function(data){
              showMyShit(data);
            }
          });
        }
    });

   $( "#SD_drop1, #SD_drop2, #SD_drop3, #SD_drop4, #SD_drop5" ).click(
    function() {

        if ($(this).hasClass("showItem_dropBox_selected")) {
            $(this).addClass("showItem_dropBox");
            $(this).removeClass("showItem_dropBox_selected");
            boxItem_count--;
            switch($(this).attr( "id" ))
            {
              case "SD_drop1":
                boxItemId1=0;
              break;
               case "SD_drop2":
                boxItemId2=0;
              break;
               case "SD_drop3":
                boxItemId3=0;
              break;
               case "SD_drop4":
                boxItemId4=0;
              break;
               case "SD_drop5":
                boxItemId5=0;
              break;
            }
        }
        else
        {
          if(boxItem_count<3)
          {
            switch($(this).attr( "id" ))
            {
              case "SD_drop1":
                boxItemId1=$(this).attr( "itemId" );
              break;
               case "SD_drop2":
                boxItemId2=$(this).attr( "itemId" );
              break;
               case "SD_drop3":
                boxItemId3=$(this).attr( "itemId" );
              break;
               case "SD_drop4":
                boxItemId4=$(this).attr( "itemId" );
              break;
               case "SD_drop5":
                boxItemId5=$(this).attr( "itemId" );
              break;
            }

            boxItem_count++;
            $(this).removeClass("showItem_dropBox");
            $(this).addClass("showItem_dropBox_selected");
          }
        }

    });

  $( "#showItem_boxUnopen" ).click(function() {

      if(!boxItem_open)
      {
         $( "#SD_drop1, #SD_drop2, #SD_drop3, #SD_drop4, #SD_drop5" ).animate({
                top: "190px",
                left: "275px"
              }, 0);
        boxItem_open=true;
          $( "#showItem_boxUnopen" ).animate({
            top: "+=100",
          }, 1000, function() {
            $( "#showItem_boxUnopen" ).text("");


              switch(especialBox)
              {
                case 1:
                 $( "#showItem_boxUnopen" ).append('<img src="images/boxes/santa_open.png" alt="Caja"  />');
                break;
                default:
                $( "#showItem_boxUnopen" ).append('<img src="images/boxes/tier'+boxTier+'_open.png" alt="Caja"  />');
                break;
              }
            
            
            $("#showItem_dropItems").show();

             $( "#SD_drop1" ).animate({
                top: "-=125px",
                left: "-=230px"
              }, 500,function(){
                    $( "#SD_drop2" ).animate({
                    top: "-=175px",
                    left: "-="+(230-(boxItem_separate))+"px"
                  }, 500,function(){

                    $( "#SD_drop3" ).animate({
                      top: "-=190px",
                      left: "-="+(230-(boxItem_separate*2))+"px"
                    }, 500, function(){

                        $( "#SD_drop4" ).animate({
                top: "-=175px",
                left: "-="+(230-(boxItem_separate*3))+"px"
              }, 500,function(){

                     $( "#SD_drop5" ).animate({
                top: "-=125px",
                left: "-="+(230-(boxItem_separate*4))+"px"
              }, 500);

              });
                    });

                  });
              });
             
        });
     }
  });

});