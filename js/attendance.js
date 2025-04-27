
function  getSessionHTML(rv)
{
    let x=``;
    x=`<option value=-1>SELECT ONE</option>`;
    let i=0;
    for(i=0;i<rv.length;i++)
    {
        let cs=rv[i];
        x=x+`<option value=${cs['id']}>${cs['year']+" "+cs['term']}</option>`;
    }
    return x;
}
function loadSessions()
{
    //make an ajax call and load the sessions from DB
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{action:"getSession"},
        beforeSend:function(e)
        {

        },
        success:function(rv)
        {
            let x=getSessionHTML(rv);
            $("#ddlclass").html(x);
        },
        error:function(e)
        {
            alert("OOPS!");
        }
    });
}
function getCourseCardHTML(classlist)
{
  let x=``;
  x=``;
  let i=0;
  for(i=0;i<classlist.length;i++)
  {
    let cc=classlist[i];
    x=x+`<div class="classcard" data-classobject='${JSON.stringify(cc)}'>${cc['code']}</div>`;
  }
  return x;
}

function fetchFacultyCourses(facid,sessionid)
{
    
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{facid:facid,sessionid:sessionid,action:"getFacultyCourses"},
        beforeSend:function(e)
        {

        },
        success:function(rv)
        {

        let x=getCourseCardHTML(rv);
        $("#classlistarea").html(x);
        },
        error:function(e)
        {

        }
    });
}

function getClassdetailsAreaHTML(classobject)
{
    let dobj=new Date();    
    let ondate=`2023-02-01`;
    let year=dobj.getFullYear();
    let month=dobj.getMonth()+1;
    if(month<10)
    {
        month="0"+month;
    }
    let day=dobj.getDate();
    if(day<10)
    {
        day="0"+day;
    }
    ondate=year+"-"+month+"-"+day;
   
 let x=`<div class="classdetails">
 <div class="code-area">${classobject['code']}</div>
 <div class="title-area">${classobject['title']}</div>
 <div class="ondate-area">
     <input type="date" value='${ondate}' id='dtpondate'>
 </div>
</div>`;
 return x;
}

function getStudentListHTML(studentList)
{
    
  let x=`<div class="studenttlist">
  <label>STUDENT LIST</label>
         </div>`;
 let i=0;
 for(i=0;i<studentList.length;i++)
 {
    let cs=studentList[i];
    let checkedState=``;
    let rowcolor='absentcolor';
    if(cs['isPresent']=='YES')
    {
        checkedState=`checked`;
        rowcolor='presentcolor'
    }
    x=x+`<div class="studentdetails ${rowcolor}" id="student${cs['id']}">
    <div class="slno-area">${(i+1)}</div>
    <div class="rollno-area">${cs['roll_no']}</div>
    <div class="name-area">${cs['name']}</div>
    <div class="checkbox-area" data-studentid='${cs['id']}'>
        <input type="checkbox" class="cbpresent" data-studentid='${cs['id']}' ${checkedState}>
        <!--we will do it dynamically, but before that lets save 
        a few attendance-->
    </div>
</div>`;
 }
  x=x+`<div class="reportsection">
  <button id="btnReport">REPORT</button>
 </div>
 <div id="divReport"></div>
  `;
  return x;
}

function fetchStudentList(sessionid,classid,facid,ondate)
{
    //make an ajax call and get the data from DB
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{facid:facid,ondate:ondate,sessionid:sessionid,classid:classid,action:"getStudentList"},
        beforeSend:function(e)
        {

        },
        success:function(rv)
        {
          let x=getStudentListHTML(rv);
          $("#studentlistarea").html(x);
        },
        error:function(e)
        {

        }
    });
}
function saveAttendance(studentid,courseid,facultyid,sessionid,ondate,ispresent)
{
    //make an ajax call and save the attendance of the student in DB
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{studentid:studentid,courseid:courseid,facultyid:facultyid,sessionid:sessionid,ondate:ondate,ispresent:ispresent,action:"saveattendance"},
        beforeSend:function(e)
        {

        },
        success:function(rv)
        {
        if(ispresent=="YES")
        {
            $("#student"+studentid).removeClass('absentcolor');
           $("#student"+studentid).addClass('presentcolor');
        }
        else{
            $("#student"+studentid).removeClass('presentcolor');
            $("#student"+studentid).addClass('absentcolor');
        }
        },
        error:function(e)
        {
            alert("OOPS!");
        }
    });
}

function downloadCSV(sessionid,classid,facid)
{
    //make ajax call to fetch from server
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{sessionid:sessionid,classid:classid,facid:facid,action:"downloadReport"},
        beforeSend:function(e)
        {

        },
        success:function(rv)
        {
       let x=`
       <object data=${rv['filename']} type="text/html" target="_parent"></object>       
       `;
       $("#divReport").html(x);
        },
        error:function(e)
        {
            alert("OOPS!");
        }
    });
}
//as soon as the page is done loading do the following
$(function(e)
{
    $(document).on("click","#btnLogout",function(ee)
    {
          $.ajax(
            {
                url:"ajaxhandler/logoutAjax.php",
                type:"POST",
                dataType:"json",
                data:{id:1},
                beforeSend:function(e){

                },
                success:function(e){
                    document.location.replace("login.php");
                },
                error:function(e){
                    alert("Something went wrong!");
                }
            }
          );
    });
    loadSessions();
    $(document).on("change","#ddlclass",function(e)
    {
        $("#classlistarea").html(``);
        $("#classdetailsarea").html(``);
        $("#studentlistarea").html(``);
        let si=$("#ddlclass").val();
        if(si!=-1)
        {
            //alert(si);
            let sessionid=si;
            let facid=$("#hiddenFacId").val();
            fetchFacultyCourses(facid,sessionid);
        }     
    });
    $(document).on("click",".classcard",function(e){
         
         let classobject=$(this).data('classobject');
        
         $("#hiddenSelectedCourseID").val(classobject['id']);
      
         let x=getClassdetailsAreaHTML(classobject);
         $("#classdetailsarea").html(x);
        
         let sessionid=$("#ddlclass").val();//sorry for the name
         let classid=classobject['id'];
         let facid=$("#hiddenFacId").val();
         let ondate=$("#dtpondate").val();
         if(sessionid!=-1)
         {
            fetchStudentList(sessionid,classid,facid,ondate);
         }
        
    });
    $(document).on("click",".cbpresent",function(e){
      //say get the check state
      let ispresent=this.checked;     
      //ispresent is a boolean value, convert it to YES NO
      if(ispresent)
      {
        ispresent="YES";
      } 
      else{
        ispresent="NO";
      }
      let studentid=$(this).data('studentid');
      let courseid=$("#hiddenSelectedCourseID").val();
      let facultyid= $("#hiddenFacId").val();
      let sessionid=$("#ddlclass").val();
      let ondate=$("#dtpondate").val();
      saveAttendance(studentid,courseid,facultyid,sessionid,ondate,ispresent);
    });
    $(document).on("change","#dtpondate",function(e){
     
         let sessionid=$("#ddlclass").val();//sorry for the name
         let classid=$("#hiddenSelectedCourseID").val();
         let facid=$("#hiddenFacId").val();
         let ondate=$("#dtpondate").val();
         if(sessionid!=-1)
         {
            fetchStudentList(sessionid,classid,facid,ondate);
         }
    });
    $(document).on("click","#btnReport",function(){
        alert("CLICKED");
      
        let sessionid=$("#ddlclass").val();//sorry for the name
        let classid=$("#hiddenSelectedCourseID").val();
        let facid=$("#hiddenFacId").val();
        downloadCSV(sessionid,classid,facid);
    })
});