<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>A Start Page</title>
    <script src="codebase/ext/dhtmlxscheduler_editors.js" type="text/javascript"></script>
    <script src="codebase/dhtmlxscheduler.js" type="text/javascript"></script>
    <script src="codebase/ext/dhtmlxscheduler_minical.js" type="text/javascript"></script>
    <script src="codebase/locale/locale_cn.js" type="text/javascript"></script>
    <link rel="stylesheet" href="codebase/dhtmlxscheduler.css" type="text/css">
    <link rel="stylesheet" href="codebase/dhtmlxscheduler_material.css" type="text/css">


</head>

<style type="text/css" >
    html, body{
        margin:0px;
        padding:0px;
        height:100%;
        overflow:hidden;
    }
    .dhx_cal_event div.dhx_footer,
    .dhx_cal_event.past_event div.dhx_footer,
    .dhx_cal_event.event_parents div.dhx_footer,
    .dhx_cal_event.event_student div.dhx_footer,
    .dhx_cal_event.event_teacher div.dhx_footer{
        background-color: transparent !important;
    }
    .dhx_cal_event .dhx_body{
        -webkit-transition: opacity 0.1s;
        transition: opacity 0.1s;
        opacity: 0.7;
    }
    .dhx_cal_event .dhx_title{
        line-height: 12px;
    }
    .dhx_cal_event_line:hover,
    .dhx_cal_event:hover .dhx_body,
    .dhx_cal_event.selected .dhx_body,
    .dhx_cal_event.dhx_cal_select_menu .dhx_body{
        opacity: 1;
    }

    .dhx_cal_event.event_student div,
    .dhx_cal_event_line.event_student{
        background-color: #FF5722 !important;
        border-color: #732d16 !important;
    }

    .dhx_cal_event.dhx_cal_editor.event_student{
        background-color: #FF5722 !important;
    }

    .dhx_cal_event_clear.event_student{
        color:#FF5722 !important;
    }

    .dhx_cal_event.event_teacher div,
    .dhx_cal_event_line.event_teacher{
        background-color: #0FC4A7 !important;
        border-color: #698490 !important;
    }

    .dhx_cal_event.dhx_cal_editor.event_teacher{
        background-color: #0FC4A7 !important;
    }

    .dhx_cal_event_clear.event_teacher{
        color:#0FC4A7 !important;
    }

    .dhx_cal_event.event_parents div,
    .dhx_cal_event_line.event_parents{
        background-color: #684f8c !important;
        border-color: #9575CD !important;
    }

    .dhx_cal_event.dhx_cal_editor.event_parents{
        background-color: #684f8c !important;
    }

    .dhx_cal_event_clear.event_parents{
        color:#B82594 !important;
    }
</style>

<script type="text/javascript" charset="utf-8">
  function init() {




      scheduler.config.xml_date = "%Y-%m-%d %H:%i";
      scheduler.config.start_on_monday = true;
      //change days
      scheduler.config.time_step = 60;
      scheduler.config.multi_day = true;
      scheduler.config.details_on_dblclick = true;
      scheduler.config.details_on_create = true;
      scheduler.locale.labels.section_subject = "subject";

      //scheduler.templates.calendar_date = scheduler.date.date_to_str("%d");


      // scheduler.init('scheduler_here',new Date(2019,4,2),"month");
      // scheduler.load("/common/events.json", "json");

      scheduler.templates.event_class = function (start, end, event) {
          var css = "";
          if (event.subject) // if event has subject property then special class should be assigned
              css += "event_" + event.subject;
          if (event.id == scheduler.getState().select_id) {
              css += " selected";
          }
          return css; // default return
      }

      var subject = [
          {key: 'default', label: '通用计划'},
          {key: 'teacher', label: '教师端'},
          {key: 'student', label: '学生端'},
          {key: 'parents', label: '家长端'}
      ];


      scheduler.config.lightbox.sections = [
          {name: "description", height: 50, map_to: "text", type: "textarea", focus: true},
          {name: "subject", height: 20, type: "select", options: subject, map_to: "subject"},
          {name: "time", height: 72, type: "time", map_to: "auto"}
      ];

      //database loading
      scheduler.load("data/events.php");
      //显示当前日期
      scheduler.init('scheduler_here', new Date(), "month");

      //if IE,kill it.
      var explorer =navigator.userAgent;
      //alert(explorer);
      //ie
      if (explorer.indexOf("Trident") >= 0 ||explorer.indexOf("MSIE")>=0 ) {
          window.location.href="IEBan.html";
      }


      var dp = new dataProcessor("data/events.php");
      dp.init(scheduler);

      dp.attachEvent("onAfterUpdateFinish",function(){
          alert("日程计划变更成功!")
      });

      dp.enablePartialDataSend(true);



     /* scheduler.parse([
          {start_date: "2019-04-18 09:00", end_date: "2019-04-18 12:00", text: "教师端新版本提测", subject: 'teacher'},
          {start_date: "2019-04-20 10:00", end_date: "2019-04-21 16:00", text: "学生端v3 Review", subject: 'student'},
          {start_date: "2019-04-21 10:00", end_date: "2019-04-21 14:00", text: "家长端尝试", subject: 'parents'},
      ], "json");*/

  }

</script>

<body onload="init();">
<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
    <div class="dhx_cal_navline">
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>

        <div class="dhx_minical_icon" id="dhx_minical_icon"  onclick="show_minical()"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab"></div>
        <div class="dhx_cal_tab" name="week_tab"></div>
        <div class="dhx_cal_tab" name="month_tab"></div>
    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>
</div>
<script type="text/javascript">
    function show_minical(){
        if (scheduler.isCalendarVisible()){
            scheduler.destroyCalendar();
        } else {
            scheduler.renderCalendar({
                position:"dhx_minical_icon",
                date:scheduler._date,
                navigation:true,
                handler:function(date,calendar){
                    scheduler.setCurrentView(date);
                    scheduler.destroyCalendar()
                }
            });
        }
    }
</script>

</body>
</html>